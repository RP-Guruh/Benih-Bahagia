$("#global-search").on("keyup", function () {
    let query = $(this).val();

    if (query.length < 2) {
        $("#search-results").hide();
        return;
    }

    $.get("/global-search", { q: query }, function (res) {
        $("#search-results").empty().show();

        if (res.menus.length) {
            $("#search-results").append('<h6 class="dropdown-header text-primary">Menus</h6>');
            res.menus.forEach(function (hit) {
                $("#search-results").append(
                    `<a href="/settings/menu/${hit.document.id}" class="search-link dropdown-item d-flex justify-content-between align-items-center">
                    <span>
                        <i class="bi bi-list me-1"></i> 
                        ${hit.document.name} 
                        <small class="text-muted">(${hit.document.code})</small>
                    </span>
                    <i data-feather="link-2" class="text-muted"></i>
                </a>`
                );
            });
            $("#search-results").append('<div class="dropdown-divider"></div>');
        }

        if (res.actions.length) {
            $("#search-results").append('<h6 class="dropdown-header text-primary">Actions</h6>');
            res.actions.forEach(function (hit) {
                $("#search-results").append(
                    `<a href="/settings/menu_action/${hit.document.id}" class="search-link dropdown-item d-flex justify-content-between align-items-center">
                    <span>
                        <i class="bi bi-lightning-fill me-1"></i> 
                        ${hit.document.name} 
                        <small class="text-muted">[${hit.document.code}]</small>
                    </span>
                    <i data-feather="link-2" class="text-muted"></i>
                </a>`
                );
            });
        }


        if (!res.menus.length && !res.actions.length) {
            $("#search-results").append(
                '<span class="dropdown-item text-muted">No results found</span>'
            );
        }
    });
});