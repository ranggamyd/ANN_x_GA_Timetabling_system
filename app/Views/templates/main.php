<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

    <link rel="icon" href="/assets/img/icon.ico" type="image/x-icon" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/atlantis.min.css">
    <link rel="stylesheet" href="/assets/css/buttons.min.css">

    <!-- Fonts and icons -->
    <script src="/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato: 400, 700, 900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                "urls": ["/assets/css/fonts.min.css"]
            },
            active: function() {
                sessionStorage.fonts = true
            }
        });
    </script>

    <title><?= $title ?> - GNA Scheduling System</title>
</head>

<body>
    <div class="wrapper">
        <?= $this->include('templates/header') ?>
        <?= $this->include('templates/sidebar') ?>

        <div class="main-panel">
            <?= $this->renderSection('content') ?>
            <?= $this->include('templates/footer') ?>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="/assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery UI -->
    <script src="/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Datatables -->
    <script src="/assets/js/plugin/datatables/datatables.min.js"></script>
    <script src="/assets/js/plugin/datatables/dataTables.buttons.min.js"></script>
    <script src="/assets/js/plugin/datatables/buttons.bootstrap4.min.js"></script>
    <script src="/assets/js/plugin/jszip/jszip.min.js"></script>
    <script src="/assets/js/plugin/pdfmake/pdfmake.min.js"></script>
    <script src="/assets/js/plugin/pdfmake/vfs_fonts.js"></script>
    <script src="/assets/js/plugin/datatables/buttons.html5.min.js"></script>
    <script src="/assets/js/plugin/datatables/buttons.print.min.js"></script>
    <script src="/assets/js/plugin/datatables/buttons.colVis.min.js"></script>

    <!-- Sweet Alert -->
    <script src="/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Atlantis JS -->
    <script src="/assets/js/atlantis.min.js"></script>

    <script>
        $(document).ready(function() {
            <?php if (session()->getFlashdata('success')) : ?>
                Swal.mixin({
                    toast: true,
                    icon: 'success',
                    title: '<?= session()->getFlashdata('success') ?>',
                    animation: true,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                }).fire();
            <?php endif ?>

            <?php if (session()->getFlashdata('error')) : ?>
                Swal.mixin({
                    toast: true,
                    icon: 'error',
                    title: '<?= session()->getFlashdata('error') ?>',
                    animation: true,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                }).fire();
            <?php endif ?>

            <?php if (session()->getFlashdata('successWithTime')) : ?>
                Swal.mixin({
                    toast: true,
                    icon: 'success',
                    title: '<?= session()->getFlashdata('successWithTime') ?>',
                    animation: true,
                    position: 'top-right',
                    showConfirmButton: false,
                }).fire();
            <?php endif ?>

            $('#datatable').DataTable({
                "lengthMenu": [
                    [-1, 10, 25, 50, 100],
                    ["All", 10, 25, 50, 100]
                ],
                "pageLength": -1,
            });

            $('#jadwaltable').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": -1,
                "buttons": [{
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel mr-2"></i>Excel',
                    titleAttr: 'Export to Excel'
                }, {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf mr-2"></i>PDF',
                    titleAttr: 'Export to PDF'
                }, {
                    extend: 'print',
                    text: '<i class="fas fa-print mr-2"></i>Print',
                    titleAttr: 'Print Schedule'
                }]
            }).buttons().container().appendTo('#jadwaltable_wrapper .col-md-6:eq(0)');

            $('#mktable').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": -1,
                "columnDefs": [{
                    targets: 7,
                    visible: false
                }],
                "buttons": [{
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel mr-2"></i>Excel',
                    titleAttr: 'Export to Excel'
                }, {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf mr-2"></i>PDF',
                    titleAttr: 'Export to PDF'
                }, {
                    extend: 'print',
                    text: '<i class="fas fa-print mr-2"></i>Print',
                    titleAttr: 'Print Schedule'
                }, {
                    extend: 'colvis',
                    text: '<i class="fas fa-eye mr-2"></i>Show Column',
                    // columns: ':not(.noVis)',
                    titleAttr: 'Show Column',
                    popoverTitle: 'Show Column'
                }]
            }).buttons().container().appendTo('#mktable_wrapper .col-md-6:eq(0)');

            $('#dosentable').DataTable({
                "responsive": true,
                "lengthChange": false,
                // "autoWidth": false,
                "pageLength": -1,
                "columnDefs": [{
                    targets: [5, 6],
                    visible: false
                }],
                "buttons": [{
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel mr-2"></i>Excel',
                    titleAttr: 'Export to Excel'
                }, {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf mr-2"></i>PDF',
                    titleAttr: 'Export to PDF'
                }, {
                    extend: 'print',
                    text: '<i class="fas fa-print mr-2"></i>Print',
                    titleAttr: 'Print Schedule'
                }, {
                    extend: 'colvis',
                    text: '<i class="fas fa-eye mr-2"></i>Show Column',
                    // columns: ':not(.noVis)',
                    titleAttr: 'Show Column',
                    popoverTitle: 'Show Column'
                }]
            }).buttons().container().appendTo('#dosentable_wrapper .col-md-6:eq(0)');

            $('#reporttable').DataTable({
                "responsive": true,
                "lengthChange": false,
                // "autoWidth": false,
                "pageLength": -1,
                // "columnDefs": [{
                //     targets: [3, 4],
                //     visible: false
                // }],
                order: [[4, 'desc']],
                "buttons": [{
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel mr-2"></i>Excel',
                    titleAttr: 'Export to Excel'
                }, {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf mr-2"></i>PDF',
                    titleAttr: 'Export to PDF'
                }, {
                    extend: 'print',
                    text: '<i class="fas fa-print mr-2"></i>Print',
                    titleAttr: 'Print Schedule'
                }, {
                    extend: 'colvis',
                    text: '<i class="fas fa-eye mr-2"></i>Show Column',
                    // columns: ':not(.noVis)',
                    titleAttr: 'Show Column',
                    popoverTitle: 'Show Column'
                }]
            }).buttons().container().appendTo('#reporttable_wrapper .col-md-6:eq(0)');

            $('#predictBtn').click(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Apakah Anda yakin ingin melakukan prediksi?',
                    text: "Proses ini membutuhkan beberapa saat",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Sedang memproses...',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            willOpen: () => {
                                swal.showLoading()
                            }
                        });

                        document.getElementById('predictForm').submit();
                    }
                });
            });

            $('#generateClassBtn').click(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Apakah Anda yakin ingin membangkitkan kelas?',
                    text: "Proses ini membutuhkan beberapa saat",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Sedang memproses...',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            willOpen: () => {
                                swal.showLoading()
                            }
                        });

                        window.location.href = '/kelas/generate';
                    }
                });
            });

            $('#generateScheduleBtn').click(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Apakah Anda yakin ingin melakukan penjadwalan?',
                    text: "Proses ini membutuhkan beberapa saat",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Sedang memproses...',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            willOpen: () => {
                                swal.showLoading()
                            }
                        });

                        window.location.href = '/jadwal/generate';
                    }
                });
            });
        });
    </script>
</body>

</html>