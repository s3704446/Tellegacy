function wfu_gdrive_authorize_app_start(token){var xhr=wfu_GetHttpRequestObject();if(xhr==null)return;var url=AdminParams.wfu_ajax_url;params=new Array(2);params[0]=new Array(2);params[0][0]="action";params[0][1]="wfu_ajax_action_gdrive_authorize_app_start";params[1]=new Array(2);params[1][0]="token";params[1][1]=token;var parameters="";for(var i=0;i<params.length;i++)parameters+=(i>0?"&":"")+params[i][0]+"="+encodeURI(params[i][1]);xhr.open("POST",url,true);xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xhr.onreadystatechange=function(){if(xhr.readyState==4)if(xhr.status==200){var start_text="wfu_gdrive_authorize_app_start:";var pos=xhr.responseText.indexOf(start_text);if(pos==-1)pos=xhr.responseText.length;var messages=xhr.responseText.substr(0,pos);var response=xhr.responseText.substr(pos+start_text.length,xhr.responseText.length-pos-start_text.length);pos=response.indexOf(":");var txt_header=response.substr(0,pos);txt_value=response.substr(pos+1,response.length-pos-1);if(txt_header=="success"){var editor_window=
window.open(wfu_plugin_decode_string(txt_value),"_blank");if(editor_window)editor_window.plugin_window=window;else alert("Please enable popup windows from the browser's settings!")}else if(txt_header=="error")console.log("Google Drive application authorization error: "+txt_value)}};xhr.send(parameters)}
function wfu_gdrive_authorize_app_finish(token){var code=document.getElementById("wfu_gdrive_authorization_code").value;if(code.trim()=="")return;var xhr=wfu_GetHttpRequestObject();if(xhr==null)return;var url=AdminParams.wfu_ajax_url;params=new Array(3);params[0]=new Array(2);params[0][0]="action";params[0][1]="wfu_ajax_action_gdrive_authorize_app_finish";params[1]=new Array(2);params[1][0]="token";params[1][1]=token;params[2]=new Array(2);params[2][0]="authcode";params[2][1]=code;var parameters=
"";for(var i=0;i<params.length;i++)parameters+=(i>0?"&":"")+params[i][0]+"="+encodeURI(params[i][1]);xhr.open("POST",url,true);xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");xhr.onreadystatechange=function(){if(xhr.readyState==4)if(xhr.status==200){var start_text="wfu_gdrive_authorize_app_finish:";var pos=xhr.responseText.indexOf(start_text);if(pos==-1)pos=xhr.responseText.length;var messages=xhr.responseText.substr(0,pos);var response=xhr.responseText.substr(pos+start_text.length,
xhr.responseText.length-pos-start_text.length);pos=response.indexOf(":");var txt_header=response.substr(0,pos);txt_value=response.substr(pos+1,response.length-pos-1);if(txt_header=="success")document.getElementById("editsettings").submit();else if(txt_header=="error")console.log("Google Drive application authorization error: "+txt_value)}};xhr.send(parameters)}
function wfu_gdrive_authorize_app_reset(token){var xhr=wfu_GetHttpRequestObject();if(xhr==null)return;var url=AdminParams.wfu_ajax_url;params=new Array(2);params[0]=new Array(2);params[0][0]="action";params[0][1]="wfu_ajax_action_gdrive_authorize_app_reset";params[1]=new Array(2);params[1][0]="token";params[1][1]=token;var parameters="";for(var i=0;i<params.length;i++)parameters+=(i>0?"&":"")+params[i][0]+"="+encodeURI(params[i][1]);xhr.open("POST",url,true);xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xhr.onreadystatechange=function(){if(xhr.readyState==4)if(xhr.status==200){var start_text="wfu_gdrive_authorize_app_reset:";var pos=xhr.responseText.indexOf(start_text);if(pos==-1)pos=xhr.responseText.length;var messages=xhr.responseText.substr(0,pos);var response=xhr.responseText.substr(pos+start_text.length,xhr.responseText.length-pos-start_text.length);pos=response.indexOf(":");var txt_header=response.substr(0,pos);txt_value=response.substr(pos+1,response.length-pos-1);if(txt_header=="success")document.getElementById("editsettings").submit();
else if(txt_header=="error")console.log("Google Drive application authorization error: "+txt_value)}};xhr.send(parameters)}
function wfu_gdrive_send_file(filepath_enc,ii){var xhr=wfu_GetHttpRequestObject();if(xhr==null)return;var nonce="";var nonce_elem=document.getElementById("wfu_gdrive_transfer_nonce");if(nonce_elem)nonce=nonce_elem.value;if(nonce=="")return;var url=AdminParams.wfu_ajax_url;params=new Array(2);params[0]=new Array(3);params[0][0]="action";params[0][1]="wfu_ajax_action_gdrive_add_file";params[1]=new Array(2);params[1][0]="file";params[1][1]=filepath_enc;params[2]=new Array(2);params[2][0]="nonce";params[2][1]=
nonce;var parameters="";for(var i=0;i<params.length;i++)parameters+=(i>0?"&":"")+params[i][0]+"="+encodeURI(params[i][1]);document.getElementById("wfu_send_to_gdrive_"+ii+"_a").href="javascript: void(0)";document.getElementById("wfu_send_to_gdrive_"+ii+"_img").style.display="inline";xhr.open("POST",url,true);xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");xhr.onreadystatechange=function(){if(xhr.readyState==4){document.getElementById("wfu_send_to_gdrive_"+ii+"_img").style.display=
"none";if(xhr.status==200){var start_text="wfu_gdrive_add_file:";var pos=xhr.responseText.indexOf(start_text);if(pos==-1)pos=xhr.responseText.length;var messages=xhr.responseText.substr(0,pos);var response=xhr.responseText.substr(pos+start_text.length,xhr.responseText.length-pos-start_text.length);pos=response.indexOf(":");var txt_header=response.substr(0,pos);txt_value=response.substr(pos+1,response.length-pos-1);if(txt_header=="success")document.getElementById("wfu_send_to_gdrive_"+ii+"_a").innerHTML=
document.getElementById("wfu_send_to_gdrive_"+ii+"_inpok").value;else document.getElementById("wfu_send_to_gdrive_"+ii+"_a").innerHTML=document.getElementById("wfu_send_to_gdrive_"+ii+"_inpfail").value}}};xhr.send(parameters)};