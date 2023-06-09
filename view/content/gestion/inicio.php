<header class="header" id="header">
    <div class="header_toggle">
        <i class="fa-solid fa-bars" id="header-toggle"></i>
    </div>
    <div class="header_img">
        <img src="https://avatars.githubusercontent.com/u/90335295?v=4" alt="">
    </div>
</header>
<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <a href="" class="nav_logo">
                <!-- <i class="fa-brands fa-html5 nav_logo-icon"></i> -->
                <img src="" class="nav_logo-icon" id="nav_logo-icon" alt="">
                <span class="nav_logo-name">TGESTIONA</span>
            </a>
            <div class="nav_list">
                <a href="inicio" class="nav_link active">
                    <i class="fa-regular fa-file-chart-pie"></i>
                    <span>Informes</span>
                </a>
                <a href="compras" class="nav_link">
                    <i class="fa-regular fa-cart-shopping"></i>
                    <span>Compras</span>
                </a>
                <a href="ventas" class="nav_link">
                    <i class="fa-regular fa-bag-shopping"></i>
                    <span>Ventas</span>
                </a>
                <a href="almacen" class="nav_link">
                    <i class="fa-regular fa-shop"></i>
                    <span>Almacen</span>
                </a>
                <a href="usuarios" class="nav_link">
                    <i class="fas fa-users"></i>
                    <span>Almacen</span>
                </a>
            </div>
        </div>

        <a href="#" class="nav_link btn-exit">
            <i class="fa-regular fa-right-from-bracket"></i>
            <span class="nav_name">Cerrar sesion</span>
        </a>
    </nav>
</div>
<div class="container-main">
    <div class="dash-top">
        <div class="dash-top-left">
            <div class="box">
                <div class="box-Bienvenido">
                    Hola <?php echo $_SESSION['userName']; ?>
                </div>
            </div>
        </div>
        <div class="dash-top-right">
            <div class="box">
                <div class="container-almacen">
                    <a class="btn-accion" href="compras">
                        <div class="box1">
                            <i class="fa-regular fa-cart-shopping"></i>
                        </div>
                        <div>compras</div>
                        <div>80</div>
                    </a>

                    <a class="btn-accion" href="ventas">
                        <div class="box2">
                            <i class="fa-regular fa-bag-shopping"></i>
                        </div>
                        <div>ventas</div>
                        <div>20</div>
                    </a>
                    <a class="btn-accion" href="almacen">
                        <div class="box3">
                            <i class="fa-regular fa-shop"></i>
                        </div>
                        <div>almacen</div>
                        <div>20</div>
                    </a>
                    <a class="btn-accion" href="usuarios">
                        <div class="box4">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>usuarios</div>
                        <div>20</div>
                    </a>
                </div>
            </div>

        </div>
    </div>
    <div class="dash-bottom">
        <div class="panel">
            <div class="titulo-panel">PANEL DE ANALISIS DE VENTAS / COMPRAS</div>
            <div class="panel-body">
                <div class="panel-acciones">
                    <div>
                        <button class="btn-accion btn-small">ULTIMOS 24 HORAS</button>
                    </div>
                    <div>
                        <button class="btn-accion btn-small">ULTIMO 15 DÍAS</button>
                    </div>
                    <div>
                        <button class="btn-accion btn-small">TOTAL MES ACTUAL</button>
                    </div>
                </div>
                <div class="panel-grafico">
                    <canvas id="analisis-cv"></canvas>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="titulo-panel">PANEL DE CONTROL USUARIOS</div>
            <div class="panel-body">
                <div class="panel-acciones">
                    <div>
                        <button class="btn-accion btn-small">ULTIMOS 24 HORAS</button>
                    </div>
                    <div>
                        <button class="btn-accion btn-small">ULTIMO 15 DÍAS</button>
                    </div>
                    <div>
                        <button class="btn-accion btn-small">TOTAL MES ACTUAL</button>
                    </div>
                </div>
                <div class="panel-grafico">
                    <canvas id="analisis-cv0"></canvas>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="titulo-panel">PANEL DE ANÁLISIS DE VENTAS /COMPRAS POR MES/AÑO</div>
            <div class="panel-body">
                <div class="panel-acciones">
                    <div>
                        <button class="btn-accion btn-small">ULTIMOS 24 HORAS</button>
                    </div>
                    <div>
                        <button class="btn-accion btn-small">ULTIMO 15 DÍAS</button>
                    </div>
                    <div>
                        <button class="btn-accion btn-small">TOTAL MES ACTUAL</button>
                    </div>
                </div>
                <div class="panel-grafico">
                    <canvas id="analisis-cv01"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>