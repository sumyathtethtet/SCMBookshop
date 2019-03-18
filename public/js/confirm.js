$(document).ready(function () 
{
    $(".delete").delegate('#btnDeleteProduct','click',function () {
        var id=$(this).attr('idd');
        var result=confirm("Are you sure want to delete?");
        if(result){

            $.ajax({
                type:'get',
                url:'/delete-book/{bookdelete_id}',
                data:{id:id},
                success:function (msg) {
                    if (msg === "<div class='alert alert-success'>delete success</div>") {
                        setInterval(function () {
                            window.location.reload();
                        }, 1000)
                    }
                }
            });
        }
    });
});