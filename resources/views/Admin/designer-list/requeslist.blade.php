@extends('Admin-layout.master')
@section('content')
<div class="login-form-bg h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-xl-11">
                <div class="form-input-content">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-5">
                            <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th class="W-25" scope="col"></th>
                                    <th scope="col">Sno.</th>
                                    <th scope="col">name</th>
                                    <th >email</th>
                                    <th >number</th>
                             
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($designer_list as $list)
                                  <tr>
                                    <td></td>
                                    <td scope="row">{{$loop->iteration}}</td>
                                     <td>{{$list->name}}</td>
                                     <td>{{$list->email}}</td>
                                     <td>{{$list->number}}</td>
                                     <td>  <a href="{{route('approve_designer',['id'=>$list->id])}}"   class=" btn btn-primary ">approve</a></td>
                                     <td>  <button data-designer-id="{{ $list->id }}" class="disapprove-button btn btn-danger ">Disapprove</button></td>
                                    <td><div id="disapproval-container"></div></td>
                                    </tr>
                                  @endforeach
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function () {
      $('.disapprove-button').on('click', function () {
          var designerId = $(this).data('designer-id');
          createDisapprovalForm(designerId);
      });

      function createDisapprovalForm(designerId) {
          var form = $('<form>', {
              method: 'POST',
              action: '/disapprove-designer',
              // class: 'form-control' // Change this URL to your disapproval route
          });
          form.append('@csrf');
          // Create a hidden input for the designer ID
          var designerIdInput = $('<input>', {
              type: 'hidden',
              name: 'designer_id',
              value: designerId,
          });

          // Create a textarea element
          var textarea = $('<textarea>', {
              name: 'disapproval_reason',
              placeholder: 'Enter reason for disapproval',
              rows: '4',
              cols: '20',
              class: 'form-control'
          });

          // Create a submit button
          var submitButton = $('<button>', {
              type: 'submit',
              text: 'Submit',
              class: 'btn btn-primary',
          });

          // Append the hidden input, textarea, and submit button to the form
          form.append(designerIdInput, textarea, submitButton);

          // Append the form to the container
          $('#disapproval-container').html(form);
      }
  });
</script>
@endsection