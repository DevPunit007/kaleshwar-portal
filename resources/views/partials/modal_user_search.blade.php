<!-- Modal for message -->
    <div class="modal fade" id="modal_user_search" tabindex="-1" role="dialog" aria-labelledby="ModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="user-search-form" class="enable-able-form" action="{{ route('search-user', app()->getLocale()) }}" method="post"> @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalTitle">Search for user</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="keyword">Keyword for search</label>
                                <input required type="text" class="form-control" id="keyword" name="keyword">
                            </div>
                        </div>
                        <p>The search includes all name fields and email addresses.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
