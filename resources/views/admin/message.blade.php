<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
  </head>
  <body>
    <!-- Sidebar Navigation start-->
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Message</h2>
            </div>
        </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th class="th_deg">Customer Name</th>
                            <th class="th_deg">Email</th>
                            <th class="th_deg">Phone</th>
                            <th class="th_deg">Message</th>    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($message as $messages )
                        
                    
                    <tr>
                        <td>{{$messages->name}}</td>
                        <td>{{$messages->email}}</td>
                        <td>{{$messages->phone}}</td>
                        <td>{{$messages->message}}</td>
                    </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </section>
    </div>
    <!-- footer-->
    @include('admin.footer')
  </body>
</html>