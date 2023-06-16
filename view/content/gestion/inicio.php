<div class="dash-top">
    <div class="dash-top-left">
        <div class="box">
            <div class="box-Bienvenido">
                <div class="bienvenida-img">
                    <img src="https://avatars.githubusercontent.com/u/90335295?v=4" alt="">
                </div>
                <div class="bienvenida-contenname">
                    <div class="bienvenida-name">
                        Hola <?php echo $_SESSION['userName']; ?>
                    </div>
                    <div class="bienvenida-rol">
                        <?php echo ucfirst($datosUser[0]['rol']) ?>
                    </div>
                </div>
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