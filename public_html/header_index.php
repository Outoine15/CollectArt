<?php
echo '<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
}

header {
    background-color: #1550bd;
    color: rgba(188, 207, 214, 0.925);
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 25px 25px;
}

.nav-header-buttons a {
    color: rgb(23, 123, 180);
    text-decoration: none;
    margin: 0 10px;
    padding: 8px 16px;
    background-color: #ffffffc0;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.nav-header-buttons a:hover {
    background-color: #777;
}
</style>

<body>

<header>
<nav>
    <div class="nav-title">
        <h1>CollectArt</h1>
    </div>
    <div class="nav-header-buttons">
        <a href="connexion_compte.php">Connexion au compte</a>
        <a href="creation_compte.php">création du compte</a>
    </div>
</nav>
</header>
</body>';
?>