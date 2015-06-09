
/* 隐藏头部 */
function hideHeader()
{
	document.getElementsByTagName("header")[0].style.display = "none";
}

//ajax 请求 只支持get请求方法
function ajaxurl(url)
{
	$.ajax({
		url:url,
		data:'is_ajax=1',
		type:'get',
		dataType:'json',
		success:function(response)
		{
			//response = eval("("+response+")");
			if(response.status == '10000')
			{
				jSuccess(response.info, {
					TimeShown : 800,
					onClosed:function(){
						//window.location.href = response.link;
						window.location.reload();
					}
				});			
			}
			else
			{
				jError(response.info);
			}
		},
		error:function()
		{
			alert('请求失败');
		}
	});
}

//确认对话框请求
function confirm_url(msg,url)
{
	if (confirm(msg))
	{
		ajaxurl(url);
	}
}
