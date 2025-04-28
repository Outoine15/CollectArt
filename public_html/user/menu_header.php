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
        <h1>Mon truc</h1>
    </div>
    <div class="nav-header-buttons">
        <a href="deconnection.php">déconnexion</a>
        <a href="vote-toile.php">voter</a>
        <a href="modifier_toile.php">Modifier Toile</a>
        <a href="creer_toile.php">créer une nouvelle toile</a>
        
    </div>
</nav>
</header>
</body>';
?>