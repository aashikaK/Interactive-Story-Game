<?php
require "db.php";
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
    exit;
}

$story_id=isset($_GET['story_id'])?$_GET['story_id']:1;
$node_id= isset($_GET['node'])?$_GET['node']: null;

if($node_id){
    $stmt=$pdo->prepare("SELECT * FROM story_nodes WHERE story_id=? AND id=?");
    $stmt->execute([$story_id,$node_id]);
}
else{
    $stmt=$pdo->prepare("select * from story_nodes where story_id=? order by id asc limit 1");
    $stmt->execute([$story_id]);
}
$node=$stmt->fetch(PDO::FETCH_ASSOC);
if(!$node){
    header("Location:index.php");
    exit;
}
$bg=($story_id==1)?"ghost-house.jpg" :(($story_id==2)?"escape-room.jpg" : "lune-date.jpg");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Adventure Story</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family: Arial, sans-serif; }
        body {
            background: url('<?php echo $bg; ?>') no-repeat center center;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .story-container {
            background: rgba(0,0,0,0.7);
            padding: 40px;
            border-radius: 20px;
            width: 700px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
        }
        h2 { font-size: 28px; margin-bottom: 30px; }

        /* grid for choices */
        .choices-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 20px;
        }

        /* each choice card */
        .choice-card {
    display: flex;
    flex-direction: column; /* image on top, text below */
    text-decoration: none;
    color: white;
    border-radius: 15px;
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
}

.choice-card:hover {
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(255,255,255,0.5);
}

/* image container */
.choice-image {
    width: 100%;
    height: 200px; /* adjust to your preferred height */
    background-size: cover;
    background-position: center;
}

/* text below image */
.choice-text {
    text-align: center;
    padding: 10px;
    font-weight: bold;
    font-size: 18px;
    background: rgba(0,0,0,0.5); /* optional dark overlay behind text */
}


        .end-msg {
            font-size: 24px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="story-container">
        <h2> <?php echo $node['text']; ?> </h2>

        <?php if(!$node['is_ending']): ?>
            <div class="choices-grid">
    <!-- Choice 1 -->
    <a class="choice-card" href="story.php?story_id=<?php echo $story_id; ?>&node=<?php echo $node['choice1_next']; ?>">
        <div class="choice-image" style="background-image: url('<?php echo $node['choice1_image']; ?>');"></div>
        <div class="choice-text"><?php echo $node['choice1_text']; ?></div>
    </a>

    <!-- Choice 2 -->
    <a class="choice-card" href="story.php?story_id=<?php echo $story_id; ?>&node=<?php echo $node['choice2_next']; ?>">
        <div class="choice-image" style="background-image: url('<?php echo $node['choice2_image']; ?>');"></div>
        <div class="choice-text"><?php echo $node['choice2_text']; ?></div>
    </a>
</div>

             <?php else: ?>
            <p class="end-msg"> The End </p>
        <a class="choice-card" href="index.php" 
           style="background-image: url('back-btn-bg.jpg');color:black; font-size:24px; display:inline-block; width:50%;text-align:center;">
          Back to Stories 
        </a>
    <?php endif; ?>
    </div>
        </body>
        </html>