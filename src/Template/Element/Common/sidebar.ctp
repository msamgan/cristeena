<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a id="dashboard-menu" href="/dashboard"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <?php if ($authUser->role->name == 'Director'): ?>
                    <?= $this->element('Director/sidebar') ?>
                <?php elseif ($authUser->role->name == 'Admin'): ?>
                    <?= $this->element('Admin/sidebar') ?>
                <?php else: ?>
                    <?= $this->element('User/sidebar') ?>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>
