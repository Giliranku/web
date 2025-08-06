<!DOCTYPE html>
<html>
<head>
    <title>Debug News Images</title>
    <style>
        .debug-item { margin: 20px 0; padding: 10px; border: 1px solid #ccc; }
        .debug-img { width: 100px; height: 80px; object-fit: cover; margin-right: 10px; }
    </style>
</head>
<body>
    <h1>Debug News Images</h1>
    <?php
    require_once 'vendor/autoload.php';
    $app = require_once 'bootstrap/app.php';
    $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
    
    $news = \App\Models\News::take(3)->get();
    
    foreach ($news as $item) {
        echo '<div class="debug-item">';
        echo '<h3>' . htmlspecialchars($item->title) . '</h3>';
        echo '<p>news_cover: ' . htmlspecialchars($item->news_cover) . '</p>';
        echo '<p>image_url accessor: ' . htmlspecialchars($item->image_url) . '</p>';
        echo '<p>getCoverUrl method: ' . htmlspecialchars($item->getCoverUrl()) . '</p>';
        echo '<p>File exists: ' . (file_exists(public_path('img/' . $item->news_cover)) ? 'YES' : 'NO') . '</p>';
        echo '<img src="' . $item->getCoverUrl() . '" class="debug-img" alt="' . htmlspecialchars($item->title) . '">';
        echo '</div>';
    }
    ?>
</body>
</html>
