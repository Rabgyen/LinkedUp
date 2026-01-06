<div class="news-container-wrapper">
    <h3>News</h3>
    <div class="news-img">
        <img src="../../images/demo-news.jpg" alt="">
    </div>
    <div class="news-info">
        <h3>News heading</h3>
        <p>News Short description!</p>
        <button id="readMoreBtn">Read More</button>
    </div>
</div>
<script>
    document.getElementById('readMoreBtn').onclick = () => {
        window.location.href = "news.php";
    };
</script>