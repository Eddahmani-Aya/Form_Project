<?php
// معلومات الاتصال بقاعدة البيانات
$host = "sql311.infinityfree.com";         // ✅ Host الصحيح
$dbname = "if0_39497081_formulaire";       // ✅ اسم القاعدة الصحيح
$username = "if0_39497081";                // ✅ اسم المستخدم الصحيح
$password = "kZRpxoJoHUAF"; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
    $stmt = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
    $messages = $stmt->fetchAll();

    echo "<h2>Liste des messages reçus</h2>";

    if (count($messages) > 0) {
        foreach ($messages as $msg) {
            echo "<hr>";
            echo "<strong>Nom:</strong> " . htmlspecialchars($msg['name']) . "<br>";
            echo "<strong>Email:</strong> " . htmlspecialchars($msg['email']) . "<br>";
            echo "<strong>Message:</strong><br>" . nl2br(htmlspecialchars($msg['message'])) . "<br>";
            echo "<small>Reçu le: " . $msg['created_at'] . "</small><br>";
        }
    } else {
        echo "Aucun message reçu.";
    }

} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>
