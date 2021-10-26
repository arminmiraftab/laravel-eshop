<!doctype html>
<html>
<head>
    <link href='https://code.jquery.com/jquery-3.3.1.min.js' rel='stylesheet' type='text/css'>

</head>
<body>
<input type='text' id='search' name='search' placeholder='Enter userid 1-27'><input type='button' value='Search' id='but_search'>
<br/>
<input type='button' value='Fetch all records' id='but_fetchall'>

<table border='1' id='userTable' style='border-collapse: collapse;'>
    <thead>
    <tr>
        <th>S.no</th>
        <th>Username</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody></tbody>
</table>

<!-- Script -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --> <!-- jQuery CDN -->
{{--<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>--}}
<script src="{{asset('FRONTED/js/jquery.js')}}"></script>

    <script type='text/javascript'>
        // $(document).ready(function () {
        //     // Fetch all records
        //     // $('#but_fetchall').click(function(){
        //     //     fetchRecords(0);
        //     // });
        //
        //     // Search by userid
        //     $('#but_search').click(function(){
        //         var userid = Number($('#search').val().trim());
        //
        //         if(userid > 0){
        //             fetchRecords(userid);
        //         }
        //
        //     });
        //
        // });
        fetchRecords();
        function fetchRecords(){
            $.ajax({
                url: "{{ route('tfetch') }}",
                type: 'get',
                dataType: 'json',
                success: function(response){
                                console.log(response);

                    var len = 0;
                    $('#userTable tbody').empty(); // Empty <tbody>
                    if(response['data'] != null){
                        len = response['data'].length;
                    }

                    if(len > 0){
                        for(var i=0; i<len; i++){
                            var id = response['data'][i].manufacture_id;
                            var username = response['data'][i].manufacture_name;
                            var name = response['data'][i].manufacture_name;
                            var email = response['data'][i].manufacture_name;

                            var tr_str = "<tr>" +
                                "<td align='center'>" + (i+1) + "</td>" +
                                "<td align='center'>" + username + "</td>" +
                                "<td align='center'>" + name + "</td>" +
                                "<td align='center'>" + email + "</td>" +
                                "</tr>";

                            $("#userTable tbody").append(tr_str);
                        }
                    }else{
                        var tr_str = "<tr>" +
                            "<td align='center' colspan='4'>No record found.</td>" +
                            "</tr>";

                        $("#userTable tbody").append(tr_str);
                    }

                }
            });
        }
    </script>
</body>
</html>