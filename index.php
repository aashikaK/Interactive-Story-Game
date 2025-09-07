<?php
session_start();
require "db.php";

// redirect if not logged in
if(!isset($_SESSION['user_id'])){
    header('Location:login.php');
    exit;
}

// fetch unique stories
$stmt = $pdo->query("SELECT DISTINCT story_id FROM story_nodes ORDER BY story_id ASC");
$story_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Adventure Stories</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family: Arial, sans-serif; }
        body {
            background: url('main-bg.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            min-height: 100vh;
        }
        h1 { text-align:center; 
            padding: 30px; 
            font-size: 40px; 
            color:rgba(6, 70, 112, 0.91);
            text-shadow: 2px 2px 5px #015157ff; }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            padding: 20px 50px;
        }
        .story-card {
            background: rgba(0,0,0,0.7);
            border-radius: 15px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .story-card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(255,255,255,0.5);
        }
        .story-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .story-card-content {
            padding: 15px;
        }
        .story-card-content h3 {
            margin-bottom: 10px;
            font-size: 22px;
        }
        .story-card-content p {
            font-size: 14px;
            color: #ddd;
        }
    </style>
</head>
<body>

<h1>Adventure Stories</h1>

<div class="grid-container">
    <?php foreach($story_ids as $story_id): 
        // pick first node as reference
        $stmt = $pdo->prepare("SELECT * FROM story_nodes WHERE story_id=? ORDER BY id ASC LIMIT 1");
        $stmt->execute([$story_id]);
        $story = $stmt->fetch(PDO::FETCH_ASSOC);

        // define title, description, image manually or dynamically
        if($story_id == 1){
            $title = "Ghost House";
            $description = "Enter the haunted house and explore mysteries...";
            $image = "ghost-house.jpg";
        } elseif($story_id == 2){
            $title = "Escape Room";
            $description = "Can you escape from the locked room?";
            $image = "escape-room.jpg";
        } else{
            $title = "Lune Date Adventure";
            $description = "Make choices and see how your date story unfolds!";
            $image = "lune-date.jpg";
        }
    ?>
    <div class="story-card" onclick="window.location='story.php?story_id=<?php echo $story_id; ?>&node=<?php echo $story['id']; ?>'">
        <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
        <div class="story-card-content">
            <h3><?php echo $title; ?></h3>
            <p><?php echo $description; ?></p>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<form action="" method="post">
        <button type="submit" name="logout" style="background-color:red; color:white; font-weight:bold; padding:10px;
        font-size:20px; margin-left:690px;margin-top:50px;width:150px; border-radius:10px;">Logout</button>
    </form>
<?php
if(isset($_POST['logout'])){
    session_destroy();
    header("Location:login.php");
    exit;
} ?>

</body>
</html>
