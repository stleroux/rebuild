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
            "drawCallback": function () {
               $('.dataTables_paginate > .pagination').addClass('pagination-sm');
            }
         }
      );
   });
</script>