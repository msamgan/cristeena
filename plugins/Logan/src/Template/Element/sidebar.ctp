<!-- Sidebar -->
<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="#">
                Menu Listing
            </a>
        </li>
        <li><a href="/" >Main Dashboard</a></li>
        <?php foreach ($dates as $date): ?>
            <li><a href="/log/view/<?= $date ?>"><?= $date ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>
<!-- /#sidebar-wrapper -->
