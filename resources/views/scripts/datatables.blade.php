<script>
   $(document).ready( function () {

      $('#datatable').DataTable(
         {
            "order": [],
            "stateSave": true,
            "pagingType": "full_numbers",
            "columnDefs": [ {
               "targets"  : 'no-sort',
               "orderable": false,
            }],
            "lengthMenu": [[10, 15, 25, 50, -1], [10, 15, 25, 50, "All"]],
            "pageLength": 15,
            "drawCallback": function () {
               $('.dataTables_paginate > .pagination').addClass('pagination-sm');
            }
         }
      );

      $('#darts').DataTable( {
        "paging":   false,
        "ordering": true,
        "info":     false,
        "searching":   false
    } );

   });
</script>