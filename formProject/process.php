<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // جلب البيانات من الفورم
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // تحقق بسيط من البيانات
    if (!empty($name) && !empty($email) && !empty($message)) {
        // هنا ممكن تزيد ترسل إيميل أو تخزن فقاعدة بيانات

        echo "<h2> Thank you $name for your message</h2>";
        echo "<p>We will respond to you via email:  $email</p>";
        echo "<p>Your message :) </p>";
        echo "<p>" . nl2br($message) . "</p>";
    } else {
        echo "Please fill in all fields.❗";
    }
} else {
    echo "Invalid entry method.";
}
?>
<?php
// معلومات قاعدة البيانات الصحيحة من InfinityFree
$host = "sql311.infinityfree.com";         // ✅ Host الصحيح
$dbname = "if0_39497081_formulaire";       // ✅ اسم القاعدة الصحيح
$username = "if0_39497081";                // ✅ اسم المستخدم الصحيح
$password = "kZRpxoJoHUAF";                // ✅ كلمة السر ديال vPanel ديالك

try {
    // الاتصال بقاعدة البيانات
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars(trim($_POST['name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $message = htmlspecialchars(trim($_POST['message']));

        if (!empty($name) && !empty($email) && !empty($message)) {
            $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':message', $message);
            $stmt->execute();

            echo "<h2> Your message has been saved successfully :) ✅</h2>";
        } else {
            echo " Please fill in all fields.❗";
        }
    } else {
        echo " Incorrect method.❗";
    }

} catch (PDOException $e) {
    echo "❌ " . $e->getMessage();
}
?>
