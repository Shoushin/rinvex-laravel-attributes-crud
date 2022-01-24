$(document).ready(function(){

     fetch_data();

     function fetch_data(){
          $.ajax({
           url:"/api/show-customer",
           dataType:"json",
           success:function(resp)
           {
            // console.log('test',resp);
            init_data(resp);
           }
          });
     }
});

//Update Data
$('body').on('click', '#updateForm', function(e){
    var id = $(this).data("id");
    var firstName = $('#firstName').val();
    var lastName = $('#lastName').val();
    var age = $('#age').val();
    var gender = $('#gender').val() == "Male" ? 1 : 0 ;
    var birthDate = $('#birthDate').val();
    var address = $('#address').val();
    $.ajax({
        url:'/api/update-customer',
        type:'POST',
        data: {  _token: '{{csrf_token()}}', first_name : firstName, last_name : lastName, age : age , gender : gender,birthdate : birthDate, address : address, entity_id: id },
        success: function (data) {
            if(data.status_code == 1){
                $('#message').css("display", "block");
                $('#message').html(data.status_message);
                $('#message').addClass("alert-success");

                init_data(data);

                $('#firstName').val('');
                $('#lastName').val('');
                $('#age').val('');
                $('#birthDate').val('');
                $('#address').val('');

                $("#buttonSave").attr('class', 'active');
                $("#buttonUpdate").attr('class', 'inActive');

            }else{
                $('#message').css("display", "block");
                $('#message').html(data.status_message);
                $('#message').addClass("alert-danger");
            }
        },
        error: function (data) {
            console.log(data);

        },
    });
});

$('body').on('click', '#cancelUpdate', function(e){

    $('#firstName').val('');
    $('#lastName').val('');
    $('#age').val('');
    $('#gender').val('');
    $('#birthDate').val('');
    $('#address').val('');

    $("#buttonSave").attr('class', 'active');
    $("#buttonUpdate").attr('class', 'inActive');
});


//Update Customer
$('body').on('click', '#updateCustomer', function(e){
    var id = $(this).data("id");
    // console.log('id', id);
    $.ajax({
        url:"/api/get-customer/"+id,
           dataType:"json",
           type:'GET',
           data: {entity_id : id },
           success:function(resp)
           {

            var customerDetails = resp.data;
            // console.log('customerDetails', customerDetails.gender);
            var gender = customerDetails.gender;
            $('#firstName').val(customerDetails.first_name);
            $('#lastName').val(customerDetails.last_name);
            $('#age').val(customerDetails.age);
            $('#gender').val(gender);
            $('#birthDate').val(customerDetails.bod);
            $('#address').val(customerDetails.address);
            $("#buttonSave").attr('class', 'inActive');
            $("#buttonUpdate").attr('class', 'active');
            $('#updateForm').attr("data-id",customerDetails.id);

           }
    });
});

//Delete Customer
$('body').on('click', '#deleteCustomer', function(e){
    var id = $(this).data("id");

    if (!confirm("Are you sure you want to delete this item?")) {
        return false;
    } 

    $.ajax({
           url:"/api/delete-customer",
           dataType:"json",
           type:'GET',
           data: {entity_id : id },
           success:function(resp)
           {

            init_data(resp);
            // console.log('test',resp);
            
        }
    });
});


//Insert Data
$('body').on('click', '#submitForm', function(){
    
    var firstName = $('#firstName').val();
    var lastName = $('#lastName').val();
    var age = $('#age').val();
    var gender = $('#gender').val() == "Male" ? 1 : 0 ;
    var birthDate = $('#birthDate').val();
    var address = $('#address').val();
    $.ajax({
        url:'/api/insert-customer',
        type:'POST',
        data: {  _token: '{{csrf_token()}}', first_name : firstName, last_name : lastName, age : age , gender : gender,birthdate : birthDate, address : address },
        success: function (data) {
            if(data.status_code == 1){
                $('#message').css("display", "block");
                $('#message').html(data.status_message);
                $('#message').addClass("alert-success");

                init_data(data);

                $('#firstName').val('');
                $('#lastName').val('');
                $('#age').val('');
                $('#birthDate').val('');
                $('#address').val('');

            }else{
                $('#message').css("display", "block");
                $('#message').html(data.status_message);
                $('#message').addClass("alert-danger");
            }
        },
        error: function (data) {
            console.log(data);

        },
    });
});


function init_data(data){

    var resp = data;
    var html = '';
    for(var count=0; count < resp.data.length; count++)
    {
        html +='<tr>';
        html +='<td>'+resp.data[count].id+'</td>';
        html +='<td>'+resp.data[count].first_name+'</td>';
        html +='<td>'+resp.data[count].last_name+'</td>';
        html +='<td>'+resp.data[count].age+'</td>';
        html +='<td>'+resp.data[count].gender+'</td>';
        html +='<td>'+resp.data[count].address+'</td>';
        html +='<td>'+resp.data[count].bod+'</td>';
        html +='<td><button class="btn btn-primary btn-sm" id="updateCustomer" data-id="'+resp.data[count].id+'" type="submit"><i class="zmdi zmdi-edit"></i></button><button id="deleteCustomer" data-id="'+resp.data[count].id+'" type="submit" class="btn btn-danger btn-sm"><i class="zmdi zmdi-delete"></i></button></td>';
        html +='<tr>';
    }
    $('tbody').html(html);
};