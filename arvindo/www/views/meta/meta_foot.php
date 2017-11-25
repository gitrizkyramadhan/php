    <!-- jQuery -->
    <!-- <script src="<?= site_url('aset') ?>/vendors/jquery/dist/jquery.min.js"></script>-->
    <!-- Bootstrap -->
    <script src="<?= site_url('aset') ?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?= site_url('aset') ?>/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?= site_url('aset') ?>/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?= site_url('aset') ?>/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?= site_url('aset') ?>/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?= site_url('aset') ?>/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?= site_url('aset') ?>/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?= site_url('aset') ?>/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?= site_url('aset') ?>/vendors/Flot/jquery.flot.js"></script>
    <script src="<?= site_url('aset') ?>/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?= site_url('aset') ?>/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?= site_url('aset') ?>/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?= site_url('aset') ?>/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?= site_url('aset') ?>/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?= site_url('aset') ?>/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?= site_url('aset') ?>/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?= site_url('aset') ?>/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?= site_url('aset') ?>/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?= site_url('aset') ?>/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?= site_url('aset') ?>/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?= site_url('aset') ?>/vendors/moment/min/moment.min.js"></script>
    <script src="<?= site_url('aset') ?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?= site_url('aset') ?>/build/js/custom.min.js"></script>
    
    <script src="<?= site_url('aset') ?>/js/jquery.formatCurrency-1.4.0.js?=<?= date('YmdHis') ?>"></script>
    
    <script src="<?= site_url('aset') ?>/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    
    <script type="text/javascript">
            $(document).ready(function(){
                $('#single_cal3').on('change', function() { 
                    var dob = new Date(this.value);
                    var today = new Date();
                    var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                    $('#usiamu').val(age);
                });
            });
            //// Sample 1
//            $(document).ready(function()
//            {
//                $('#currencyButton').click(function()
//                {
//                    $('#currencyField').formatCurrency();
//                    $('#currencyField').formatCurrency('.currencyLabel');
//                });
//            });
//            
//            // Sample 2
//            $(document).ready(function()
//            {
//                $('.currency').blur(function()
//                {
//                    $('.currency').formatCurrency({ colorize: true, negativeFormat: '-%s%n', roundToDecimalPlace: 0 });
//                });
//            });
            
            
             function penawarans(){
                var avalA=0;
                $('.penawaran').each(function() {
                    if(this.value == ''){
                        this.value = 0;
                    }
                    if(parseInt(this.value,10) !='') avalA += parseInt(this.value,10);
                });
                
                $('#total').val(avalA);
                
                ppn = $('#total').val();
                ppn = Math.round(ppn * 0.1);
                $('#ppn').val(ppn);
                
                pph = $('#pph').val();
                if(pph == ''){
                    pph = 0;
                    pph = $('#pph').val(pph);   
                }
                
                totalAkhir = avalA + ppn + parseInt(pph);
                $('#totalAkhir').val(totalAkhir);
             }
             
             $('.penawaran').on('keyup',function() {
                var avalA=0;

                $('.penawaran').each(function() {
                    if(this.value == ''){
                        this.value = 0;
                    }
                    if(parseInt(this.value,10) !='') avalA += parseInt(this.value,10);
                });
                
                $('#total').val(avalA);
                
                ppn = $('#total').val();
                ppn = Math.round(ppn * 0.1);
                $('#ppn').val(ppn);
                
                pph = $('#pph').val();
                if(pph == ''){
                    pph = 0;
                    pph = $('#pph').val(pph);   
                }
                
                totalAkhir = avalA + ppn + parseInt(pph);
                $('#totalAkhir').val(totalAkhir);
            });
            
            $('.pph').on('keyup',function() {
                var avalA=0;

                $('.penawaran').each(function() {
                    if(this.value == ''){
                        this.value = 0;
                    }
                    if(parseInt(this.value,10) !='') avalA += parseInt(this.value,10);
                });
                
                //$('#total').val(avalA);
                
                ppn = $('#total').val();
                ppn = Math.round(ppn * 0.1);
                $('#ppn').val(ppn);
                
                pph = $('#pph').val();
                if(pph == ''){
                    pph = 0;
                    pph = $('#pph').val(pph);   
                }
                pph = $('#pph').val();
                
                totalAkhir = avalA + ppn + parseInt(pph);
                $('#totalAkhir').val(totalAkhir);
                
            });
            
            function count(act){
                if (act == 'delete'){
                    isi = parseInt($('#count').val()) - 1;
                }else{
                    isi = parseInt($('#count').val()) + 1;
                }
                $('#count').val(isi);
                $('#ttl').html(isi);
                return isi;
            }
            var site_url = "<?= site_url(); ?>";
            var base_url = "<?= base_url(); ?>";
        </script>
        
        <script src="<?= site_url('aset') ?>/js/myscript.js?<?= date('YmdHis') ?>"></script>