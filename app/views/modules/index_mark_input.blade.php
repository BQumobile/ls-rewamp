@extends('layouts.main')


@section('content')

<div class="m-b-md">
	<form class="navbar-form navbar-left " role="search">
        <div class="form-group">
             <div class="input-group" style="min-width:1080px;">
                     <span class="input-group-btn">
                       <span class="btn btn-sm bg-white b-white btn-icon" style="min-height:50px;font-size:24px;"><i class="fa fa-search"></i></span>
                     </span>
                     <input type="text" style="min-height:50px;font-size:24px;" id="search_text" class="form-control input-sm no-border" placeholder="Search SAN , LS SN , Name ...">
                   </div>

        </div>
      </form>
      </div>

              <br>
              <br>


 <section class="panel panel-default">
<div class="ssc">
                <a href="{{ URL::to('/modules/marks-input/create') }}" class="btn btn-sm btn-success btncustom">New Marks Input</a></div>
                <div class="table-responsive">
                  <table class="table table-striped m-b-none" data-ride="datatables" id="student_datatable">
                    <thead>
                      <tr>
                        <th width="20%">SAN</th>
                        <th width="20%">LS SN</th>
                        <th width="35%">NAME(s)</th>
                        <th width="10%">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    @foreach ($students as $student)
                    <?php
                    $s = DB::table('students')->where('id','=',$student->id)->first();
                    $student_application_status = DB::table('student_application_status')->where('san','=',$student->san)->orderBy('id', 'desc')->first();

                    ?>
                       <tr>
                           <td>{{ $s->san }}</td>
                           <td>{{ $s->ls_student_number }}</td>
                           <td>{{ $s->title.' '.$s->initials_1.' '.$s->initials_2.' '.$s->initials_3.' '.$s->forename_1.' '.$s->forename_2.' '.$s->forename_3.' '.$s->surname }}</td>

                                     <td style="min-width: 160px;">
                                     <!--
                          @if (Sentry::getUser()->hasAccess('modules.show_marks_input'))
                                                     <a class="btn btn-sm btn-primary" href="{{ URL::to('/modules/marks-input/'.$s->ls_student_number) }}">More</a>&nbsp;&nbsp;
                          @endif -->
                          @if (Sentry::getUser()->hasAccess('modules.create_marks_input'))
                                                     <a class="btn btn-sm btn-warning" href="{{ URL::to('/modules/marks-input/create/'.$s->ls_student_number) }}">Update Marks</a>&nbsp;&nbsp;
                          @endif
                                                     </td>
                         </tr>
                    @endforeach

                    </tbody>
                  </table>
                </div>
              </section>
@stop


@section('post_css')
{{ HTML::style('js/datatables/datatables.css'); }}

<style>
.btncustom{   position: absolute;
              right: 2%;
              top: 50%;
              margin-top: 1.5%;
              z-index:100;}
.ssc{position:relative;}
</style>
@stop

@section('post_js')
  {{ HTML::script('js/datatables/jquery.dataTables.min.js'); }}
  <script>

    $('#student_datatable').dataTable({
"sPaginationType": "full_numbers"
    });



    oTable = $('#student_datatable').dataTable();
  $('#search_text').keyup(function(){
         oTable.fnFilter($(this).val());
  })

  $('#student_datatable_filter').hide();
  </script>

@stop

@section('main_menu')

 @stop

 @section('breadcrumb')
   <li><a href="{{ URL::to('/modules') }}">Modules</a></li>
   <li class="active"><a href="{{ URL::to('/modules/marks-input/create') }}">Marks - Input</a></li>

 @stop