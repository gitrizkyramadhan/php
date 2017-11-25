
<!-- top tiles -->
<div class="row tile_count">
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Penawaran</span>
        <div class="count"><?php echo $cpenawaran ?></div>
        <!--<span class="count_bottom"><i class="green">4% </i> From last Week</span>-->
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-clock-o"></i> Total PO</span>
        <div class="count"><?php echo $cpo ?></div>
        <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>-->
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Produksi</span>
        <div class="count"><?php echo $cproduksi ?></div>
        <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> Total Realisasi</span>-->
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Realisasi</span>
        <div class="count"><?php echo $creal ?></div>
        <!--<span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>-->
    </div>
    <!--    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Material</span>
            <div class="count">2,315</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>-->
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Voucer Listrik</span>
        <div class="count"><?php echo $clistrik ?></div>
        <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>-->
    </div>
</div>
<!-- /top tiles -->

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="dashboard_graph">

            <div class="row x_title">
                <div class="col-md-6">
                    <h3>LIST TAGIHAN <small>TOP PRIORITY</small></h3>
                </div>
                <!--
                <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                        
                    </div>
                </div>
                -->
            </div>

            <!--awal section-->
            <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                    <h2>List Listrik</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Beli</th>
                                <th>Tanggal Penggunaan Awal</th>
                                <th>Tanggal Penggunaan Akhir</th>
                                <th>Nominal</th>
                                <th>Watt</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($listrik as $val) {
                                ++$i;
                                if ($i == 1 || $i == 2 || $i == 3) {
                                    echo "<tr style=background-color:red;color:white>";
                                }
                                echo "<th>" . $i . "</th>";
                                echo "<td>" . $val['tgl_beli'] . "</td>";
                                echo "<td>" . $val['tgl_penggunaan_awal'] . "</td>";
                                echo "<td>" . $val['tgl_penggunaan_akhir'] . "</td>";
                                echo "<td>" . $val['nominal'] . "</td>";
                                echo "<td>" . $val['watt'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--akhir section-->

            <!--awal section-->
            <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                    <h2>List Pajak</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Pajak</th>
                                <th>Kode Lokasi</th>
                                <th>Jatuh Tempo</th>
                                <th>Tanggal Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($pajak as $val) {
                                ++$i;
                                if ($i == 1 || $i == 2 || $i == 3) {
                                    echo "<tr style=background-color:red;color:white>";
                                }
                                echo "<th>" . $i . "</th>";
                                echo "<td>" . $val['kdpajak'] . "</td>";
                                echo "<td>" . $val['kdlokasi'] . "</td>";
                                echo "<td>" . $val['jatuh_tempo'] . "</td>";
                                echo "<td>" . $val['tgl_bayar'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--akhir section-->

            <!--awal section-->
            <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                    <h2>List Ijin</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Lokasi</th>
                                <th>Tanggal Ijin</th>
                                <th>Tanggal Akhir Ijin</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($ijinlokasi as $val) {
                                ++$i;
                                if ($i == 1 || $i == 2 || $i == 3) {
                                    echo "<tr style=background-color:red;color:white>";
                                }
                                echo "<th>" . $i . "</th>";
                                echo "<td>" . $val['kdlokasi'] . "</td>";
                                echo "<td>" . $val['tgl_ijin'] . "</td>";
                                echo "<td>" . $val['tgl_akhir'] . "</td>";
                                echo "<td>" . $val['nominal'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--akhir section-->
            
            <!--awal section-->
            <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                    <h2>List Tagihan</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPWP</th>
                                <th>Nama Perusahaan</th>
                                <th>Tanggal Jatuh Tempo</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($tagihan as $val) {
                                ++$i;
                                if ($i == 1 || $i == 2 || $i == 3) {
                                    echo "<tr style=background-color:red;color:white>";
                                }
                                echo "<th>" . $i . "</th>";
                                echo "<td>" . $val['npwp'] . "</td>";
                                echo "<td>" . $val['nama'] . "</td>";
                                echo "<td>" . $val['date_realisasi'] . "</td>";
                                echo "<td>" . $val['nominal'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--akhir section-->


        </div>
    </div>

</div>
<br />