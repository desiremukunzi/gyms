@extends('receptionist.layouts.app')
@section('content')
<div class="container">
  <div class="panel panel-default panel-fill">
        <div class="panel-heading">
            <h3 class="panel-title">Payment Form</h3>
        </div>
    <div class="panel-body">
  <form method="post" action="{{url('receptionist/payment')}}">
    {{ csrf_field() }}

    @if($customers !=null)
    <div class="form-group">
      <label>customer Name</label>
      <select name="customer_id" class="form-control" style="width:350px">
                    <option value="">--- Select Customer ---</option>
                    @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->firstName}}</option>
                    @endforeach
                </select>
    </div>
    @endif

    @if($receptionists !=null)
    <div class="form-group">
      <label>receptionist Name</label>
      <select name="receptionist_id" class="form-control" style="width:350px">
                    <option value="">--- Select Recesptionist ---</option>
                    @foreach ($receptionists as $receptionist)
                    <option value="{{ $receptionist->id }}">{{ $receptionist->name}}</option>
                    @endforeach
                </select>
    </div>
    @endif

            <div class="form-group">
                <select id="category" name="category_id" class="form-control" style="width:350px" >
                <option value="" selected disabled>Select</option>
                  @foreach($categories as $key => $category)
                  <option value="{{$key}}"> {{$category}}</option>
                  @endforeach
                  </select>
            </div>
            <div class="form-group">
                <label for="title">Select Sport:</label>
                <select name="sport_id" id="sport" class="form-control" style="width:350px">
                </select>
            </div>
         
            <div class="form-group">
                <label for="title">Select Membership:</label>
                <select name="membership_id" id="membership" class="form-control" style="width:350px">
                </select>
            </div>
      </div>
    </div>
  </div>
   <div class="form-group">
      <div class="col-md-2"></div>
      <input type="submit" class="btn btn-primary">
    </div>
  </form>
</div>
</div>
</div>



<script type="text/javascript">
    $('#category').change(function(){
    var categoryID = $(this).val();    
    if(categoryID){
        $.ajax({
           type:"GET",
           url:"{{url('get-sport-list')}}?category_id="+categoryID,
           success:function(res){               
            if(res){
                $("#sport").empty();
                $("#sport").append('<option>Select</option>');
                $.each(res,function(key,value){
                    $("#sport").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#sport").empty();
            }
           }
        });
    }else{
        $("#sport").empty();
        $("#membership").empty();
    }      
   });
    $('#sport').on('change',function(){
    var sportID = $(this).val();    
    if(sportID){
        $.ajax({
           type:"GET",
           url:"{{url('get-membership-list')}}?sport_id="+sportID,
           success:function(res){               
            if(res){
                $("#membership").empty();
                $.each(res,function(key,value){
                    $("#membership").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#membership").empty();
            }
           }
        });
    }else{
        $("#membership").empty();
    }
        
   });
</script>

@endsection

