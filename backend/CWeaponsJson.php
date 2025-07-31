<?php
if(!isset($_GET["weapons"])) {
    die("No weapons file found.");
} else {
    $weapons = file($_GET["weapons"], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

$weapons_json = file_get_contents($_GET["weapons"]);

enum Rarities: string {
    case Common = "Common";
    case Uncommon = "Uncommon";
    case Rare = "Rare";
    case Epic = "Epic";
    case Legendary = "Legendary";
    case Mythic = "Mythic";
    case Exotic = "Exotic";

    public static function fromPath(string $path): self {
        // Check for WaffleTruck in path for Exotic
        if (stripos($path, 'WaffleTruck') !== false) {
            return self::Exotic;
        }
        if (preg_match('/_(SR|UC|R|VR|UR|EX|X|Name)(?:_|\\.|$)/i', $path, $matches)) {
            $code = strtoupper($matches[1]);
            return match ($code) {
                'C' => self::Common,
                'UC' => self::Uncommon,
                'R' => self::Rare,
                'VR' => self::Epic,
                'SR' => self::Legendary,
                'UR' => self::Mythic,
                'EX', 'X', 'NAME' => self::Exotic,
                default => self::Common,
            };
        }
        return self::Common;
    }
}

class Weapon {
    private $name;
    private $rarity;
    private $path;

    public function __construct(string $line) {
        $parts = explode(" /", $line, 2);
        $this->name = trim($parts[0]);
        $this->path =  isset($parts[1]) ? trim($parts[1]) : "";
        $this->rarity = Rarities::fromPath($this->path);
    }

    public function getName(): string {
        return $this->name;
    }
    public function getRarity(): Rarities {
        return $this->rarity;
    }
    public function getPath(): string {
        return $this->path;
    }
}

function createJsonWeapons($list) {
    $weapons = [];
    $i = 0;
    foreach($list as $line) {
        $id = $i;
        $weaponObj = new Weapon($line);
        $weapons[] = [
            "id" => $id,
            "name" => $weaponObj->getName(),
            "rarity" => $weaponObj->getRarity()->value,
            "path" => "/" . $weaponObj->getPath()
        ];
        $i++;
    }
    return $weapons;
}

if(!file_exists("weapons.json")) {
    $jsonWeapons = createJsonWeapons($weapons);
    file_put_contents("weapons.json", json_encode($jsonWeapons, JSON_PRETTY_PRINT));
    echo "File created successfully.";
    header("Location: weapons.json");
    exit;

} else {
    echo "File already exists.";
}