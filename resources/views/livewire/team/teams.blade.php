<div>
    <style>
        .modal {
  position: fixed !important;
  z-index: 9999 !important;
}

.modal-backdrop {
  z-index: 9998 !important;
}
    </style>

    <div class="main_content_iner ">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Team Membes List</h3>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <h4>Team Leaders</h4>
                                    <div class="box_right d-flex lms_block">
                                        <div class="serach_field_2">
                                            <div class="search_inner">
                                                <form Active="#">
                                                    <div class="search_field">
                                                        <input type="text" placeholder="Search content here...">
                                                    </div>
                                                    <button type="submit"> <i class="ti-search"></i> </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="add_button ms-2">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalCenter" class="btn_1">Add New</a>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="QA_table mb_30">
                                    <!-- table-responsive -->
                                    <table class="table lms_table_active3 ">
                                        <thead>
                                            <tr>
                                                <th scope="col">title</th>
                                                <th scope="col">Group</th>
                                                <th scope="col">description</th>
                                                <th scope="col">Image</th> 
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($slides !=null)
                                            @foreach ($slides as $slide)
                                                   <tr>
                                                        <th scope="row"> <a href="#" class="question_content">{{$slide->title}}</a></th>
                                                        <td>{{$slide->group}}</td>
                                                        <td>{!! $slide->description !!}</td>
                                                        <td><img class="img" src="{{ asset('storage/'.$slide->image) }}" width="300px" height="300px"></td>
                                                        <td>{{$slide->status}}</td>
                                                      
                                                     </tr>
                                            @endforeach
                                         
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</div>
@push('modals')
    @livewire('slider.slider-modal')
@endpush