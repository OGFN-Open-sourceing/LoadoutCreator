<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fortnite Loadout Creator</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    /* --- Demo.html inspired styles --- */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      background: #000;
      color: #e0e0e0;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Inter', sans-serif;
      min-height: 100vh;
      overflow-x: hidden;
    }
    .container {
      max-width: 1500px;
      margin: 0 auto;
      padding: 2rem;
    }
    .gradient-title {
      font-size: 3rem;
      font-weight: bold;
      text-align: center;
      margin-bottom: 2rem;
      text-shadow: 0 2px 4px rgba(0,0,0,0.3);
      background: linear-gradient(45deg, #5f5b85, #9d8fef, #5f5b85, #9d8fef, #5f5b85);
      background-clip: text;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-size: 200% 200%;
      animation: animatedgradient 6s linear infinite, fadeIn 1.3s ease-in-out;
    }
    @keyframes animatedgradient {
      0% { background-position: 200% 50%; }
      100% { background-position: 0% 50%; }
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    /* --- Search Bar --- */
    .search-bar {
      display: flex;
      align-items: center;
      gap: 1em;
      margin-bottom: 1.5em;
      background: rgba(25, 21, 44, 0.2);
      border-radius: 18px;
      padding: 0.9em 1.5em;
      box-shadow: 0 2px 16px #9d8fef33;
      border: 1.5px solid #9d8fef44;
      position: relative;
      overflow: hidden;
    }
    .search-icon {
      width: 2em; height: 2em;
      display: flex; align-items: center; justify-content: center;
      background: linear-gradient(120deg, #5f5b85, #9d8fef);
      border-radius: 50%;
      box-shadow: 0 0 12px #9d8fef66;
      z-index: 1;
      position: relative;
    }

    .search-input {
      flex: 1;
      padding: 1em 1.3em;
      border-radius: 12px;
      border: none;
      background: rgba(255,255,255,0.07);
      color: #fff;
      font-size: 1.15em;
      outline: none;
      box-shadow: 0 2px 8px #9d8fef22;
      transition: box-shadow 0.2s, background 0.2s;
      z-index: 1;
      font-family: 'Inter', sans-serif;
      font-weight: 600;
      letter-spacing: 0.01em;
    }
    .search-input:focus {
      box-shadow: 0 0 0 2px #9d8fef, 0 2px 8px #9d8fef44;
      background: rgba(157,143,239,0.08);
    }
    /* --- Rarity Filters --- */
    .rarity-filters {
      display: flex;
      gap: 0.7em;
      margin-bottom: 1.2em;
      flex-wrap: wrap;
      justify-content: center;
      z-index: 1;
    }
    .rarity-btn {
      color: white;
      border: none;
      border-radius: 10px;
      padding: 0.5em 1.3em;
      font-weight: 700;
      font-size: 1.05em;
      opacity: 0.8;
      cursor: pointer;
      transition: opacity 0.18s, box-shadow 0.18s, background 0.22s;
      box-shadow: 0 2px 8px #9d8fef11;
      letter-spacing: 0.01em;
      background: #222;
    }
    .rarity-btn.active {
      opacity: 1;
      box-shadow: 0 4px 16px #9d8fef33;
    }
    .rarity-btn[data-rarity="Common"] { background: linear-gradient(90deg, #888 0%, #aaa 100%); }
    .rarity-btn[data-rarity="Uncommon"] { background: linear-gradient(90deg, #3ad13a 0%, #baffba 100%); }
    .rarity-btn[data-rarity="Rare"] { background: linear-gradient(90deg, #3a8fd1 0%, #badaff 100%); }
    .rarity-btn[data-rarity="Epic"] { background: linear-gradient(90deg, #a259e6 0%, #6e2ca6 100%); }
    .rarity-btn[data-rarity="Legendary"] { background: linear-gradient(90deg, #ffe066 0%, #ffb800 100%); }
    .rarity-btn[data-rarity="Mythic"] { background: linear-gradient(90deg, #ffb800 0%, #ff3a3a 100%); }
    .rarity-btn[data-rarity="Exotic"] { background: linear-gradient(90deg, #00fff7 0%, #007c7a 100%); }
    /* --- Weapons List --- */
    .weapons-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 1.2em;
      max-height: 340px;
      overflow-y: auto;
      background: rgba(25, 21, 44, 0.2);
      border-radius: 18px;
      padding: 1.2em;
      min-height: 80px;
      margin-bottom: 2em;
      box-shadow: 0 2px 16px #9d8fef11;
      border: 1.5px solid #9d8fef22;
      backdrop-filter: blur(6px);
    }
    .weapon-card {
      border-radius: 18px;
      padding: 1.2em 1.2em;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      gap: 0.3em;
      cursor: pointer;
      border: 2.5px solid transparent;
      transition: border 0.18s, box-shadow 0.18s, background 0.22s;
      box-shadow: 0 4px 16px #9d8fef22;
      min-height: 110px;
      min-width: 200px;
      max-width: 260px;
      width: 220px;
      position: relative;
      background: rgba(20,20,20,0.7);
    }
    .weapon-card:hover {
      border: 2.5px solid #fff;
      box-shadow: 0 8px 32px #9d8fef33;
    }
    .weapon-name {
      font-size: 1.18em;
      font-weight: 800;
      color: #fff;
      margin-bottom: 0.1em;
      word-break: break-word;
      letter-spacing: 0.01em;
      text-shadow: 0 2px 8px #9d8fef22;
    }
    /* --- Weapon Rarity Styling --- */
    .weapon-rarity {
      margin-bottom: 0.2em;
      padding: 0.18em 0.7em;
      border-radius: 0.7em;
      font-size: 0.98em;
      font-weight: 700;
      color: #fff;
      background: #181825;
      display: inline-block;
      letter-spacing: 0.03em;
      text-shadow: none;
      position: relative;
      transition: color 0.2s, background 0.2s;
    }
    .weapon-card[data-rarity="Common"] .weapon-rarity,
    .slot.filled .weapon-rarity[data-rarity="Common"] {
      color: #bdbdbd;
      background: #232323;
    }
    .weapon-card[data-rarity="Uncommon"] .weapon-rarity,
    .slot.filled .weapon-rarity[data-rarity="Uncommon"] {
      color: #3ad13a;
      background: #1a2b1a;
    }
    .weapon-card[data-rarity="Rare"] .weapon-rarity,
    .slot.filled .weapon-rarity[data-rarity="Rare"] {
      color: #3a8fd1;
      background: #182232;
    }
    .weapon-card[data-rarity="Epic"] .weapon-rarity,
    .slot.filled .weapon-rarity[data-rarity="Epic"] {
      color: #a259e6;
      background: #231a32;
    }
    .weapon-card[data-rarity="Legendary"] .weapon-rarity,
    .slot.filled .weapon-rarity[data-rarity="Legendary"] {
      color: #ffb800;
      background: #2b251a;
    }
    .weapon-card[data-rarity="Mythic"] .weapon-rarity,
    .slot.filled .weapon-rarity[data-rarity="Mythic"] {
      color: #ff3a3a;
      background: #2b1a1a;
    }
    .weapon-card[data-rarity="Exotic"] .weapon-rarity,
    .slot.filled .weapon-rarity[data-rarity="Exotic"] {
      color: #00fff7;
      background: #1a2323;
    }

    /* --- Compact Number Input Styling (from demo) --- */
    .number-input-container {
      position: relative;
      display: inline-flex;
      align-items: center;
      width: 80px;
      height: 40px;
      background: rgba(58, 49, 83, 0.2);
      backdrop-filter: blur(5px);
      border: 1px solid rgba(157, 143, 239, 0.3);
      border-radius: 8px;
      transition: all 0.3s ease;
    }
    .number-input-container:hover {
      border-color: rgba(157, 143, 239, 0.5);
    }
    .number-input-container:focus-within {
      border-color: #9d8fef;
      box-shadow: 0 0 0 3px rgba(157, 143, 239, 0.1);
    }
    .number-input--wrapper {
        display: flex;
        flex-direction: row;
    }
    .number-input--wrapper < div {
        display: flex;
        flex-direction: column;
    }
    .number-input {
      flex: 1;
      background: transparent;
      border: none;
      padding: 0 4px;
      color: #e0e0e0;
      font-size: 0.9rem;
      text-align: center;
      outline: none;
      -moz-appearance: textfield;
      min-width: 0;
    }
    .number-input::-webkit-outer-spin-button,
    .number-input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    .number-input::placeholder {
      color: #666;
    }
    .number-controls {
      display: flex;
      flex-direction: column;
      height: 100%;
      width: 20px;
      flex-shrink: 0;
    }
    .number-btn {
      flex: 1;
      background: rgba(157, 143, 239, 0.1);
      border: none;
      border-left: 1px solid rgba(157, 143, 239, 0.2);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.15s ease;
      color: #9d8fef;
      user-select: none;
    }
    .number-btn:first-child {
      border-top-right-radius: 7px;
      border-bottom: 0.5px solid rgba(157, 143, 239, 0.1);
    }
    .number-btn:last-child {
      border-bottom-right-radius: 7px;
      border-top: 0.5px solid rgba(157, 143, 239, 0.1);
    }
    .number-btn:hover {
      background: rgba(157, 143, 239, 0.2);
      border-left-color: rgba(157, 143, 239, 0.4);
    }
    .number-btn:active {
      background: rgba(157, 143, 239, 0.3);
      transform: scale(0.95);
    }
    .number-btn.up::before {
      content: '';
      width: 0;
      height: 0;
      border: 2.5px solid transparent;
      border-bottom-color: #9d8fef;
      border-top: none;
      display: block;
    }
    .number-btn.down::before {
      content: '';
      width: 0;
      height: 0;
      border: 2.5px solid transparent;
      border-top-color: #9d8fef;
      border-bottom: none;
      display: block;
    }

    .input-icon {
        padding-top: 4px;
        padding-left: 5px;
        margin-right: -5px;
    }

    /* --- Loadout Section --- */
    .loadout-section {
      background: rgba(25, 21, 44, 0.2);
      border-radius: 22px;
      padding: 1.5em 2em 2em 2em;
      box-shadow: 0 2px 16px #9d8fef22;
      margin-bottom: 1.5em;
      border: 1.5px solid #9d8fef22;
      backdrop-filter: blur(8px);
      position: relative;
    }
    .loadout-title {
      font-size: 1.25em;
      font-weight: 800;
      color: #9d8fef;
      margin-bottom: 1.1em;
      letter-spacing: 0.01em;
      text-shadow: 0 2px 8px #9d8fef22;
      text-align: center;
    }
    .loadout-bar {
      display: flex;
      gap: 1.5em;
      justify-content: center;
      margin-bottom: 1em;
      margin-top: 0.5em;
      flex-wrap: wrap;
    }
    .slot {
      width: 220px;
      height: 140px;
      background: rgba(20,20,20,0.7);
      border-radius: 16px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      position: relative;
      border: 2.5px solid #9d8fef44;
      box-shadow: 0 2px 8px #9d8fef11;
      transition: border 0.18s, background 0.22s;
      cursor: pointer;
      overflow: hidden;
      user-select: none;
    }
    .slot.filled {
      border: 2.5px solid #9d8fef;
      background: rgba(40,40,60,0.85);
    }
    .slot.drag-over {
      border: 2.5px dashed #ff61f6;
      background: rgba(157,143,239,0.12);
    }
    .slot .remove-btn {
      position: absolute;
      top: 7px;
      right: 10px;
      background: none;
      border: none;
      color: #fff;
      font-size: 1.4em;
      cursor: pointer;
      opacity: 0.7;
      transition: opacity 0.15s;
      z-index: 2;
    }
    .slot .remove-btn:hover {
      opacity: 1;
      color: #ff61f6;
    }
    .slot .amount-bar {
      display: flex;
      align-items: center;
      gap: 0.3em;
      margin-top: 0.3em;
    }
    .slot .amount-btn {
      background: linear-gradient(120deg, #5f5b85, #9d8fef);
      border: none;
      color: #fff;
      font-size: 1.1em;
      border-radius: 6px;
      width: 1.8em;
      height: 1.8em;
      cursor: pointer;
      transition: background 0.15s;
      display: flex; align-items: center; justify-content: center;
      font-weight: 700;
    }
    .slot .amount-btn:hover {
      background: #9d8fef;
    }
    .slot input[type=number] {
      background: rgba(157,143,239,0.08);
      color: #fff;
      border-radius: 6px;
      border: 1.5px solid #9d8fef;
      font-size: 1em;
      padding: 0.1em 0.2em;
      text-align: center;
      outline: none;
      box-shadow: none;
      width: 2.5em;
      font-weight: 700;
    }
    .slot .ammo-bar {
      display: flex;
      align-items: center;
      gap: 0.3em;
      margin-top: 0.3em;
    }
    .slot .ammo-label {
      font-size: 0.95em;
      color: #b0b0b0;
      margin-right: 0.2em;
    }
    /* --- C++ Code Section --- */
    .cpp-section {
      margin-top: 1.5em;
      background: rgba(25, 21, 44, 0.2);
      border-radius: 18px;
      padding: 1.2em 1.5em;
      box-shadow: 0 2px 16px #9d8fef22;
      position: relative;
      border: 1.5px solid #9d8fef22;
      backdrop-filter: blur(8px);
    }
    .cpp-title {
      color: #9d8fef;
      font-weight: 800;
      margin-bottom: 0.7em;
      font-size: 1.15em;
      letter-spacing: 0.01em;
      text-shadow: 0 2px 8px #9d8fef22;
    }
    .cpp-actions {
      position: absolute;
      top: 1.2em;
      right: 1.5em;
      display: flex;
      gap: 0.5em;
    }
    .cpp-btn {
      background: linear-gradient(120deg, #5f5b85, #9d8fef);
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 0.4em 1.1em;
      font-size: 1em;
      font-weight: 700;
      cursor: pointer;
      transition: background 0.15s;
      display: flex; align-items: center; gap: 0.4em;
      letter-spacing: 0.01em;
      box-shadow: 0 2px 8px #9d8fef22;
    }
    .cpp-btn:hover {
      background: #9d8fef;
    }
    .cpp-code {
      display: block;
      width: 100%;
      min-height: 90px;
      max-height: 260px;
      background: transparent;
      color: #fff;
      border-radius: 10px;
      padding: 1em;
      font-size: 1.08em;
      font-family: 'Fira Mono', 'Consolas', monospace;
      overflow-x: auto;
      line-height: 1.5;
      white-space: pre;
      border: none;
      outline: none;
      margin-top: 0.5em;
      background: rgba(157,143,239,0.06);
      box-shadow: 0 2px 8px #9d8fef11;
      letter-spacing: 0.01em;
    }
    /* --- C++ Syntax Highlighting Styles --- */
    .cpp-keyword { color: #9d8fef; font-weight: 700; }
    .cpp-type { color: #ffe066; font-weight: 700; }
    .cpp-func { color: #ffb800; }
    .cpp-comment { color: #6a9955; font-style: italic; }
    .cpp-string { color: #ff61f6; }
    .cpp-number { color: #ffe066; }
    .cpp-operator { color: #ffb800; font-weight: bold; }

    /* --- Custom Number Inputs for Loadout Controls --- */
    .slot-controls {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 0.7em;
      margin-top: 0.2em;
    }
    .slot-label {
      display: flex;
      align-items: center;
      gap: 0.18em;
      font-size: 0.93em;
      color: #b0b0b0;
      font-weight: 600;
      opacity: 0.85;
    }
    .slot-label .icon {
      width: 1.1em;
      height: 1.1em;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: #9d8fef22;
      border-radius: 50%;
      margin-right: 0.12em;
      opacity: 0.7;
      /* Placeholder for Lucide icon */
    }
    .slot-number-input {
      width: 2.2em;
      height: 1.7em;
      border-radius: 6px;
      border: 1.2px solid #9d8fef;
      background: rgba(157,143,239,0.13);
      color: #fff;
      font-size: 1em;
      font-weight: 700;
      text-align: center;
      outline: none;
      box-shadow: none;
      margin: 0 0.08em;
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: textfield;
      padding: 0 1.5em 0 0.5em;
      position: relative;
    }
    .slot-number-input::-webkit-inner-spin-button, .slot-number-input::-webkit-outer-spin-button {
      opacity: 1;
      background: #9d8fef33;
      border-radius: 3px;
      width: 1.1em;
      height: 1.1em;
      cursor: pointer;
    }
    .slot-number-input[type=number]::-ms-input-placeholder {
      color: #b0b0b0;
      opacity: 0.7;
    }
    .slot-number-input::placeholder {
      color: #b0b0b0;
      opacity: 0.7;
    }
    /* --- Responsive --- */
    @media (max-width: 1100px) {
      .weapons-list { grid-template-columns: repeat(2, 1fr); }
      .container { padding: 1.2em 0.5em; }
      .slot, .weapon-card { width: 180px; min-width: 150px; }
    }
    @media (max-width: 600px) {
      .weapons-list { grid-template-columns: 1fr; }
      .loadout-bar { gap: 0.7em; }
      .slot, .weapon-card { width: 120px; min-width: 100px; }
    }

    .input-warning {
      position: relative;
      display: inline-flex;
      align-items: center;
      margin-left: 4px;
      cursor: pointer;
    }
    .input-warning svg {
      color: #ff3a3a;
      vertical-align: middle;
    }
    .warning-tooltip {
      display: none;
      position: absolute;
      left: 50%;
      top: 120%;
      transform: translateX(-50%);
      background: #181825;
      color: #fff;
      border-radius: 6px;
      padding: 0.5em 1em;
      font-size: 0.92em;
      white-space: nowrap;
      box-shadow: 0 2px 8px #0008;
      z-index: 10;
      pointer-events: none;
    }
    .input-warning:hover .warning-tooltip,
    .input-warning:focus .warning-tooltip {
      display: block;
    }
  </style>
</head>
<body>
<div class="container">
  <h1 class="gradient-title">Loadout Creator</h1>
  <div class="search-bar">
    <span class="search-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg>
    </span>
    <input type="text" class="search-input" id="searchInput" placeholder="Search all items...">
  </div>
  <div class="rarity-filters" id="rarityFilters"></div>
  <div class="weapons-list" id="weaponsList"></div>
  <div class="loadout-section">
    <div class="loadout-title">Your Loadout (max 5)</div>
    <div style="display: flex; justify-content: center; margin-bottom: 1.2em;">
      <input type="text" id="loadoutNameInput" placeholder="Enter loadout name..." style="font-size:1.1em; padding:0.5em 1em; border-radius:10px; border:1.5px solid #9d8fef44; background:rgba(25,21,44,0.2); color:#fff; font-weight:600; width:260px; max-width:90%; margin:0 auto 0 auto; text-align:center; box-shadow:0 2px 16px #9d8fef22; outline:none;" />
    </div>
    <div class="loadout-bar" id="loadoutBar"></div>
  </div>
  <div class="cpp-section">
    <div class="cpp-title">C++ Code</div>
    <div class="cpp-actions">
      <button class="cpp-btn" id="copyCodeBtn">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy-icon lucide-copy"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
      </button>
    </div>
    <pre class="cpp-code" id="cppCode" tabindex="0"></pre>
  </div>
</div>
<script>
  // --- State ---
  let allWeapons = [];
  let search = "";
  let rarity = "All";
  let loadout = [null, null, null, null, null]; // { name, rarity, path, amount, ammo }
  const rarities = ["All", "Common", "Uncommon", "Rare", "Epic", "Legendary", "Mythic", "Exotic"];
  // --- Fetch weapons from API ---
  fetch('./backend/api.php')
    .then(res => res.json())
    .then(data => {
      allWeapons = data;
      renderRarityFilters();
      renderWeapons();
      renderLoadout();
    });
  // --- UI Render ---
  function renderRarityFilters() {
    const el = document.getElementById('rarityFilters');
    el.innerHTML = '';
    rarities.forEach(r => {
      const btn = document.createElement('button');
      btn.className = 'rarity-btn' + (rarity === r ? ' active' : '');
      btn.textContent = r;
      btn.setAttribute('data-rarity', r);
      btn.onclick = () => { rarity = r; renderWeapons(); renderRarityFilters(); };
      el.appendChild(btn);
    });
  }
  function renderWeapons() {
    const el = document.getElementById('weaponsList');
    let filtered = allWeapons.filter(w =>
      (rarity === "All" || w.rarity === rarity) &&
      w.name.toLowerCase().includes(search.toLowerCase())
    );
    el.innerHTML = '';
    filtered.forEach(w => {
      const card = document.createElement('div');
      card.className = 'weapon-card';
      card.setAttribute('data-rarity', w.rarity);
      card.onclick = () => addToLoadout(w);
      card.innerHTML = `
        <div class="weapon-name">${w.name}</div>
        <div class="weapon-rarity">${w.rarity}</div>
      `;
      el.appendChild(card);
    });
    if (filtered.length === 0) {
      el.innerHTML = `<div style="grid-column: 1/-1; text-align:center; opacity:0.7;">No items found.</div>`;
    }
  }
  function renderLoadout() {
    const el = document.getElementById('loadoutBar');
    el.innerHTML = '';
    for (let i = 0; i < 5; ++i) {
      const slotWrapper = document.createElement('div');
      slotWrapper.style.display = 'flex';
      slotWrapper.style.flexDirection = 'column';
      slotWrapper.style.alignItems = 'center';
      slotWrapper.style.marginBottom = '0.5em';
      const slot = document.createElement('div');
      slot.className = 'slot' + (loadout[i] ? ' filled' : '');
      slot.setAttribute('draggable', !!loadout[i]);
      slot.setAttribute('data-slot', i);
      // Drag events
      slot.ondragstart = e => {
        if (!loadout[i]) return e.preventDefault();
        e.dataTransfer.setData('text/plain', i);
        slot.classList.add('dragging');
      };
      slot.ondragend = e => {
        slot.classList.remove('dragging');
      };
      slot.ondragover = e => {
        e.preventDefault();
        slot.classList.add('drag-over');
      };
      slot.ondragleave = e => {
        slot.classList.remove('drag-over');
      };
      slot.ondrop = e => {
        e.preventDefault();
        slot.classList.remove('drag-over');
        const from = parseInt(e.dataTransfer.getData('text/plain'));
        if (from === i) return;
        // Swap
        [loadout[from], loadout[i]] = [loadout[i], loadout[from]];
        renderLoadout();
      };
      if (loadout[i]) {
        // Rarity color for slot
        const rarity = loadout[i].rarity;
        slot.innerHTML = `
          <button class="remove-btn" title="Remove" onclick="removeFromLoadout(${i});event.stopPropagation();">&times;</button>
          <div class="weapon-name" style="font-size:1em;text-align:center;">${loadout[i].name}</div>
          <div class="weapon-rarity" data-rarity="${rarity}" style="margin-bottom:0.2em;">${rarity}</div>
        `;
        slotWrapper.appendChild(slot);
        // Amount and ammo controls below slot, using numberinput.html structure
        const controls = document.createElement('div');
        controls.className = 'slot-controls';
        controls.innerHTML = `
          <div class="number-input--wrapper">
            <div class="number-input-container" style="margin-right:0.5em;">
              <div class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-backpack-icon lucide-backpack"><path d="M4 10a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"/><path d="M8 10h8"/><path d="M8 18h8"/><path d="M8 22v-6a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v6"/><path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/></svg></div>
              <input type="number" class="number-input" min="1" max="99" step="1" value="${loadout[i].amount}" id="amount-${i}" oninput="setAmount(${i},this.value);event.stopPropagation();">
              <div class="number-controls">
                <button class="number-btn up" type="button" onclick="changeAmount(${i},1);event.stopPropagation();"></button>
                <button class="number-btn down" type="button" onclick="changeAmount(${i},-1);event.stopPropagation();"></button>
              </div>
            </div>
            <div class="input-warning" tabindex="0">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-warning-icon lucide-file-warning"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
              <span class="warning-tooltip">Amount will be ignored for weapons/items that can't stack.</span>
            </div>
          </div>

          <div class="number-input--wrapper">
            <div class="number-input-container" style="margin-right:0.5em;">
              <div class="input-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bullet-icon"><circle cx="12" cy="12" r="8"/><rect x="11" y="6" width="2" height="6" rx="1"/><rect x="11" y="14" width="2" height="2" rx="1"/></svg></div>
              <input type="number" class="number-input" min="0" max="999" step="1" value="${loadout[i].ammo}" id="ammo-${i}" oninput="setAmmo(${i},this.value);event.stopPropagation();">
              <div class="number-controls">
                <button class="number-btn up" type="button" onclick="changeAmmo(${i},1);event.stopPropagation();"></button>
                <button class="number-btn down" type="button" onclick="changeAmmo(${i},-1);event.stopPropagation();"></button>
              </div>
            </div>
            <div class="input-warning" tabindex="0">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-warning-icon lucide-file-warning"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
              <span class="warning-tooltip">Ammo will be ignored for items that don't use ammo.</span>
            </div>
          </div>
        `;
        slotWrapper.appendChild(controls);
      } else {
        slot.innerHTML = `<div style="opacity:0.4;text-align:center;">Empty Slot</div>`;
        slotWrapper.appendChild(slot);
      }
      el.appendChild(slotWrapper);
    }
    renderCpp();
  }
  function renderCpp() {
    const code = generateCppCode();
    document.getElementById('cppCode').innerHTML = highlightCpp(code);
  }
  // --- Actions ---
  document.getElementById('searchInput').addEventListener('input', e => {
    search = e.target.value;
    renderWeapons();
  });
  document.getElementById('loadoutNameInput').addEventListener('input', () => {
    renderCpp();
  });
  function addToLoadout(w) {
    for (let i = 0; i < 5; ++i) {
      if (!loadout[i]) {
        loadout[i] = {
          ...w,
          amount: 1,
          ammo: typeof w.ammo !== "undefined" ? w.ammo : 0
        };
        renderLoadout();
        return;
      }
    }
    // Show error (optional)
  }
  window.removeFromLoadout = function(idx) {
    loadout[idx] = null;
    renderLoadout();
  }
  window.changeAmount = function(idx, delta) {
    if (!loadout[idx]) return;
    let amt = loadout[idx].amount + delta;
    if (amt < 1) amt = 1;
    if (amt > 99) amt = 99;
    loadout[idx].amount = amt;
    renderLoadout();
  }
  window.setAmount = function(idx, val) {
    if (!loadout[idx]) return;
    let amt = parseInt(val) || 1;
    if (amt < 1) amt = 1;
    if (amt > 99) amt = 99;
    loadout[idx].amount = amt;
    renderLoadout();
  }
  window.changeAmmo = function(idx, delta) {
    if (!loadout[idx]) return;
    let ammo = loadout[idx].ammo + delta;
    if (ammo < 0) ammo = 0;
    if (ammo > 999) ammo = 999;
    loadout[idx].ammo = ammo;
    renderLoadout();
  }
  window.setAmmo = function(idx, val) {
    if (!loadout[idx]) return;
    let ammo = parseInt(val) || 0;
    if (ammo < 0) ammo = 0;
    if (ammo > 999) ammo = 999;
    loadout[idx].ammo = ammo;
    renderLoadout();
  }
  // --- C++ Code Generation (with ammo if present) ---
  function generateCppCode() {
    const loadoutName = document.getElementById('loadoutNameInput').value.trim();
    let varName = loadoutName
      .replace(/[^a-zA-Z0-9_]/g, '') // Remove non-alphanumeric/underscore
      .replace(/^\d+/, ''); // Remove leading digits
    if (!varName) varName = 'loadout';
    let code = '';
    if (loadoutName) {
      code += `// ${loadoutName}\n`;
    } else {
        code += `// Loadout\n`;
    }
    code += `auto ${varName} = new Loadout();\n`;
    loadout.forEach((item, i) => {
      if (item) {
        if (item.ammo > 0) {
          code += `${varName}->AddItem(StaticLoadObject<UFortItemDefinition>(TEXT(\"${item.path}\")), ${item.amount}, ${item.ammo}); // ${item.name}\n`;
        } else {
          code += `${varName}->AddItem(StaticLoadObject<UFortItemDefinition>(TEXT(\"${item.path}\")), ${item.amount}); // ${item.name}\n`;
        }
      }
    });
    return code.trim();
  }
  // --- C++ Syntax Highlighting (from demo.html, adapted) ---
  function highlightCpp(code) {
    code = code.replace(/[&<>]/g, c => ({
      '&': '&amp;', '<': '&lt;', '>': '&gt;'
    }[c]));
    code = code.replace(/(\/\/.*)/g, '<span class="cpp-comment">$1</span>');
    code = code.replace(/(<span class="cpp-comment">.*?<\/span>)|("[^"]*")/g, (m, comment, str) => {
      if (comment) return comment;
      return `<span class="cpp-string">${str}</span>`;
    });
    code = code.replace(/(<span class="cpp-(?:comment|string)">.*?<\/span>)|(\b\d+\b)/g, (m, span, num) => {
      if (span) return span;
      return `<span class="cpp-number">${num}</span>`;
    });
    code = code.replace(/(<span class="cpp-(?:comment|string|number)">.*?<\/span>)|(\bUFortItemDefinition\b)/g, (m, span, type) => {
      if (span) return span;
      return `<span class="cpp-type">${type}</span>`;
    });
    code = code.replace(/(<span class="cpp-(?:comment|string|number|type)">.*?<\/span>)|(\bStaticLoadObject\b)/g, (m, span, fn) => {
      if (span) return span;
      return `<span class="cpp-func">${fn}</span>`;
    });
    code = code.replace(/(<span class="cpp-[^>]+">.*?<\/span>)|(\-\>|\:\:)/g, (m, span, op) => {
      if (span) return span;
      return `<span class="cpp-operator">${op}</span>`;
    });
    code = code.replace(/(<span class="cpp-[^>]+">.*?<\/span>)|(\bTEXT\b)/g, (m, span, macro) => {
      if (span) return span;
      return `<span class="cpp-keyword">${macro}</span>`;
    });
    return code;
  }
  // --- Copy code ---
  document.getElementById('copyCodeBtn').onclick = () => {
    const code = generateCppCode();
    navigator.clipboard.writeText(code);
  };
</script>
</body>
</html>
