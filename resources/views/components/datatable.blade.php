<div class="card bg-white border-0 rounded-3 mb-4">
    <div class="card-body p-0">
        <!-- Topbar: show entries + search + add -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-4">
            <!-- Left: Show entries + Search -->
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <!-- Show entries -->
                <div class="d-flex align-items-center gap-2">
                    <label for="{{ $id }}-length" class="mb-0 fw-medium">Show</label>
                    <select id="{{ $id }}-length" class="form-select form-select-sm w-auto">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>

                <!-- Search -->
                <div class="position-relative table-src-form">
                    <input type="text" id="{{ $id }}-search" class="form-control ps-5" placeholder="Search here">
                    <i
                        class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y ms-2">search</i>
                </div>
            </div>
          
            <!-- Right: Add button -->
             @if($showAddButton === true || $showAddButton == 1)
                <div>
                    <a href="{{ url($buttonAddUrl) }}"
                        class="btn btn-outline-primary py-1 px-3 fs-14 fw-medium rounded-3 hover-bg">
                        <span class="d-flex align-items-center gap-1">
                            <i class="ri-add-line fs-18"></i>
                            <span>{{ $buttonAddTitle }}</span>
                        </span>
                    </a>
                </div>
            @endif
        </div>


        <!-- Table -->
        <div class="default-table-area style-two default-table-width">
            <div class="table-responsive">
                <table id="{{ $id }}" class="table align-middle">
                    <thead>
                        <tr>
                            @foreach($columns as $col)
                                <th>{{ $col['label'] }}</th>
                            @endforeach
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <!-- Custom Pagination -->
        <div id="{{ $id }}-pagination" class="p-4"></div>
    </div>
</div>

@push('scripts')
    <script>
        $(function () {
            let table = $('#{{ $id }}').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                lengthChange: false,
                paging: true,
                info: false,
                dom: 't', 
                ajax: {
                    url: "{{ $ajaxUrl }}",
                    data: function (d) {
                        d.keyword = $('#{{ $id }}-search').val();
                    }
                },
                columns: [
                    @foreach($columns as $col)
                        { data: '{{ $col['data'] }}', name: '{{ $col['data'] }}' },
                    @endforeach
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        width: '120px'
                    }
                ],

                drawCallback: function (settings) {
                    let api = this.api();
                    let pageInfo = api.page.info();

                    let start = pageInfo.start + 1;
                    let end = pageInfo.end;
                    let total = pageInfo.recordsTotal;
                    let perPage = pageInfo.length;

                    let html = `
                    <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap">
                        <span class="fs-13 fw-medium">Items per page: ${perPage}</span>
                        <div class="d-flex align-items-center">
                            <span class="fs-13 fw-medium me-2">${start} - ${end} of ${total}</span>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination mb-0 justify-content-center">
                                    <li class="page-item ${pageInfo.page === 0 ? 'disabled' : ''}">
                                        <a class="page-link icon" href="#" data-page="${pageInfo.page - 1}">
                                            <i class="material-symbols-outlined">keyboard_arrow_left</i>
                                        </a>
                                    </li>
                                    <li class="page-item ${pageInfo.page >= pageInfo.pages - 1 ? 'disabled' : ''}">
                                        <a class="page-link icon" href="#" data-page="${pageInfo.page + 1}">
                                            <i class="material-symbols-outlined">keyboard_arrow_right</i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                `;

                    $('#{{ $id }}-pagination').html(html);
                }
            });

            // search
            $('#{{ $id }}-search').on('keyup', function () {
                table.ajax.reload();
            });

            $('#{{ $id }}-length').on('change', function () {
                table.page.len($(this).val()).draw();
            });

         
            $('#{{ $id }}-pagination').on('click', '.page-link', function (e) {
                e.preventDefault();
                let page = $(this).data('page');
                if (page !== undefined) {
                    table.page(page).draw('page');
                }
            });
        });
    </script>
@endpush