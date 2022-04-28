<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-6">
                <h1>database crud</h1>
            </div>
            <div class="col-6">
                <button class="btn-primary btn float-right" onclick="add()">
                        등록하기
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th scope="col">번호</th>
                            <th scope="col">작성자</th>
                            <th scope="col">제목</th>
                            <th scope="col">내용</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- 데이터 들어갈 자리                        -->
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal" tableindex="-1" role="dialog" aria-hidden="true" aria-labelledby="modal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-dialog modal-lg" role="document">
                    <form onsubmit="save_data()">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel2">추가</h5>
                            </div>
                        </div>
                        <div class="modalbody">
                            <input type="hidden" name="id" id="id">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">작성자</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="title">제목</label>
                                    <input type="text" name="title" id="title" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="memo">내용</label>
                                    <input type="text" name="memo" id="memo" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="mr-auto">
                                    <button class=" btn  btn-primary" type="submit">등록</button>
                                    <button class=" btn  btn-secondary" data-dismiss="modal" type="button">취소</button>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        var save_method,table,message;

        $(function (){
            table=$('.table').DataTable({
                "processing":true,
                "ajax":"ajax/ajax_table.php?action=table_data"
            });
        });

        function add(){
            save_method="add";
            $('#modal').modal('show');
            $('#modal form')[0].reset();
            $('.modal-title').text('정보를 입력해주세요');
        }
        function form_edit(){
            save_method="edit",
                $.ajax({
                    url:"ajax/ajax_table.php?action=form_data&id"+id,
                    type:"GET",
                    dataType:"JSON",
                    success:function (data) {
                        $('modal').modal('show');
                        $('.modal-title').text('수정할 내용을 입력해주세요')
                        $('#id').val(data.id);
                        $('#name').val(data.name);
                        $('#title').val(data.title);
                        $('#memo').val(data.memo);
                },
                    error:function(){
                        alert("다시 확인 필요!")
                    }
                })};
        function save_data(){
            if(save_method=="add"){
                url="ajax/ajax_table.php?action=insert";
                message="입력성공"
            }else{
                url:"ajax/ajax_table.php?action=update";
                message="수정성공"
            }
            $.ajax({
                url:url,
                type:'POST',
                data:$('#modal form').serialize(),
                success:function (){
                    $('#modal').modal('hide');
                    $('#modal form')[0].reset();
                    alert(message);
                    table.ajax.reoload();
                },
                error:function () {
                    alert("입력된 값이 맞는지 확인 해보세요")
                }
            });
            return false
        }
        function delete_data(id){
            if(confirm("삭제하시곘습니까")){
                $.ajax({
                    url:"ajax/ajax_table.php?action=delete&id"+id,
                    type:"GET",
                    success:function (data){
                        alert("성공적으로 삭제 완료")
                        table.ajax.reload();
                    },
                    error:function () {
                        alert("입력된 값이ㅣ 맞는지 확인 해보세요")
                    }
                })
            }
        }
    </script>

</body>
</html>
