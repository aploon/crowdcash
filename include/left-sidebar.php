<div class="main-sidebar sidebar-style-2" style="overflow: hidden; outline: none;" tabindex="1">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/realproject/pages/profile/tb/tb-admin.php"> <img alt="image" src="/crowdcash/assets/img/logo.png" class="header-logo"> <span class="logo-name">Otika</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="dropdown <?php if (strpos($_SERVER['REQUEST_URI'], 'tb') && strpos($_SERVER['REQUEST_URI'], 'crowdcash')) {
                                    echo 'active';
                                } else {
                                    echo '';
                                } ?>">
                <a href="/crowdcash/tb/tb-admin.php" class="nav-link toggled"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg><span>Dashboard</span></a>
            </li>
            <li class="dropdown <?php if (strpos($_SERVER['REQUEST_URI'], 'secteur') && strpos($_SERVER['REQUEST_URI'], 'crowdcash')) {
                                    echo 'active';
                                } else {
                                    echo '';
                                } ?>">
                <a href="/crowdcash/secteur" class="nav-link toggled"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg><span>Secteurs</span></a>
            </li>
            <li class="dropdown <?php if (strpos($_SERVER['REQUEST_URI'], 'projet') && strpos($_SERVER['REQUEST_URI'], 'crowdcash')) {
                                    echo 'active';
                                } else {
                                    echo '';
                                } ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    </svg><span>Projets</span></a>
                <ul class="dropdown-menu" style="display: none;">
                    <li class="<?php if (strpos($_SERVER['REQUEST_URI'], 'projet') && strpos($_SERVER['REQUEST_URI'], 'en-attente')) {
                                    echo 'active';
                                } else {
                                    echo '';
                                } ?>"><a href="/crowdcash/projet/en-attente/index.php" class="nav-link" href="widget-chart.html">En attente</a></li>
                    <li class="<?php if (strpos($_SERVER['REQUEST_URI'], 'projet') && strpos($_SERVER['REQUEST_URI'], 'en-cour')) {
                                    echo 'active';
                                } else {
                                    echo '';
                                } ?>"><a href="/crowdcash/projet/en-cour/index.php" class="nav-link" href="widget-chart.html">En cours</a></li>
                    <li class="<?php if (strpos($_SERVER['REQUEST_URI'], 'projet') && strpos($_SERVER['REQUEST_URI'], 'finalise')) {
                                    echo 'active';
                                } else {
                                    echo '';
                                } ?>"><a href="/crowdcash/projet/finalise/index.php" class="nav-link" href="widget-chart.html">Finalisés</a></li>
                    <li class="<?php if (strpos($_SERVER['REQUEST_URI'], 'projet') && strpos($_SERVER['REQUEST_URI'], 'rejete')) {
                                    echo 'active';
                                } else {
                                    echo '';
                                } ?>"><a href="/crowdcash/projet/rejete/index.php" class="nav-link" href="widget-data.html">Rejetés</a></li>
                </ul>
            </li>

            <li class="dropdown <?php if (strpos($_SERVER['REQUEST_URI'], 'messagerie') && strpos($_SERVER['REQUEST_URI'], 'crowdcash')) {
                                    echo 'active';
                                } else {
                                    echo '';
                                } ?>">
                <a href="/crowdcash/messagerie/" class="nav-link toggled"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg><span>Messagerie</span></a>
            </li>

            <li class="dropdown <?php if (strpos($_SERVER['REQUEST_URI'], 'promoteur') && strpos($_SERVER['REQUEST_URI'], 'crowdcash')) {
                                    echo 'active';
                                } else {
                                    echo '';
                                } ?>">
                <a href="/crowdcash/promoteur/" class="nav-link toggled"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg><span>Promoteurs</span></a>
            </li>
            <li class="dropdown <?php if (strpos($_SERVER['REQUEST_URI'], 'contributeur') && strpos($_SERVER['REQUEST_URI'], 'crowdcash')) {
                                    echo 'active';
                                } else {
                                    echo '';
                                } ?>">
                <a href="/crowdcash/contributeur/" class="nav-link toggled"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg><span>Contributeurs</span></a>
            </li>
            <li class="dropdown <?php if (strpos($_SERVER['REQUEST_URI'], 'depense') && strpos($_SERVER['REQUEST_URI'], 'crowdcash')) {
                                    echo 'active';
                                } else {
                                    echo '';
                                } ?>">
                <a href="/crowdcash/depense/" class="nav-link toggled"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg><span>Dépenses</span></a>
            </li>
            <li class="dropdown <?php if (strpos($_SERVER['REQUEST_URI'], 'salaire') && strpos($_SERVER['REQUEST_URI'], 'crowdcash')) {
                                    echo 'active';
                                } else {
                                    echo '';
                                } ?>">
                <a href="/crowdcash/salaire/" class="nav-link toggled"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg><span>Salaires</span></a>
            </li>
            <li class="dropdown <?php if (strpos($_SERVER['REQUEST_URI'], 'personnel') && strpos($_SERVER['REQUEST_URI'], 'crowdcash')) {
                                    echo 'active';
                                } else {
                                    echo '';
                                } ?>">
                <a href="/crowdcash/personnel/" class="nav-link toggled"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg><span>Personnel</span></a>
            </li>
            <li class="dropdown <?php if (strpos($_SERVER['REQUEST_URI'], 'journal') && strpos($_SERVER['REQUEST_URI'], 'crowdcash')) {
                                    echo 'active';
                                } else {
                                    echo '';
                                } ?>">
                <a href="/crowdcash/journal" class="nav-link toggled"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg><span>Journaux</span></a>
            </li>
            <li class="dropdown <?php if (strpos($_SERVER['REQUEST_URI'], 'parametre') && strpos($_SERVER['REQUEST_URI'], 'crowdcash')) {
                                    echo 'active';
                                } else {
                                    echo '';
                                } ?>">
                <a href="/crowdcash/parametre/" class="nav-link toggled"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg><span>Paramètres</span></a>
            </li>
        </ul>
    </aside>
</div>