<script>
    function searchColumsDataTable(datatable) {
        datatable.api().columns([1, 2, 3, 4]).every(function () {
            var column = this;
            var input = document.createElement("input");
            if(column.selector.cols == 3){    
                input = document.createElement("select");
                createSelectColumnUniqueDatatableAll(input, @json($gender));
            }else if(column.selector.cols == 4){
                input = document.createElement("select");
                createSelectColumnUniqueDatatableAll(input, @json($role));
            }
    
            input.setAttribute('placeholder', 'Nhập từ khóa');
            input.setAttribute('class', 'form-control');
    
            $(input).appendTo($(column.footer()).empty())
            .on('change', function () {
                column.search($(this).val(), false, false, true).draw();
            });
        }); 
    }
    </script>