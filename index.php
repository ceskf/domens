<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript" src="jquery-1.9.1.js"></script>
<script type="text/javascript">
	if(document.getElementsByClassName == undefined) { 
   		document.getElementsByClassName = function(cl) { 
      		var retnode = []; 
      		var myclass = new RegExp('\\b'+cl+'\\b'); 
      		var elem = this.getElementsByTagName('*'); 
      		for (var i = 0; i < elem.length; i++) { 
         		var classes = elem[i].className; 
         		if (myclass.test(classes)) { 
            		retnode.push(elem[i]); 
         		} 
      		} 
      		return retnode; 
   		} 
	}; 
	function toggleUkr(){
		var val = document.getElementById('urk').checked;
		//if (val == 'true') val = true; else val = false;
		var checks = document.getElementsByClassName('ukr');
		for (var i=0; i<checks.length; i++){
			checks[i].checked = val;
		}
	}
	function toggleWorld(){
		var val = document.getElementById('world').checked;
		//if (val == 'true') val = true; else val = false;
		var checks = document.getElementsByClassName('world');
		for (var i=0; i<checks.length; i++){
			checks[i].checked = val;
		}
	}
	$(function(){
		$("#more_domains").bind('click', function(){
			$("#ukr_domains").slideToggle('slow', function(){
				if(!$(this).is(":hidden")) {
					$("#more_domains").text("Скрыть домены");
				}
				else{
					$("#more_domains").text("Больше доменов");	
				}
			});
			$("#world_domains").slideToggle('slow');
		});
		/*$("#check").bind('click', function(){
			var name = $("#domain_name").val();
			var ch = $("input.domain:checked, input.ukr:checked, input.world:checked");
			$("#domains_result").empty();
			$("#ukr_domains").slideUp('slow', function(){
				$("#more_domains").text("Больше доменов");
			});
			$("#world_domains").slideUp('slow');
			for (var i=0;i<ch.length;i++){
				var val= name+"."+$(ch[i]).attr('name');
				var dom = "domres_"+i;
				var whois = "whois_"+i;
				var id = $(ch[i]).attr('id');
				id = id.split("_")[1];
				$("#domains_result").append("<tr><td>"+val+"</td><td id='"+whois+"' align='center'></td><td id='"+dom+"' align='center'><img src='loading.gif' width='20px'></td></tr>");
				check_domain(val,dom,id,whois);
				
			}
		});*/
	});
	function check_domain(domain,dom,id,whois){
		$.ajax({
        	url: "check_domains.php",
        	type: "POST",
        	async: false,
        	dataType: "json",   
        	data: {domain:domain},
        	success: function(data){
        		if (data == 'registered'){
            		$("#"+dom).empty().append('Занят');
        			$("#"+whois).empty().append('<a onclick="window.open(\'check_domains.php?domain='+domain+'\', \'newwindow\',\'width=300, height=250\'); return false;" href="#">WHOIS</a>');
            	}
            	else
            		$("#"+dom).empty().append('<a href="https://www.mgnhost.ru/manager/billmgr?func=register&project=1&welcomfunc=domain.order.2&welcomparam=operation=register domain='+domain+'&price='+id+'">Зарегистрировать</a>');
            	//console.log('AAA');
        	}
    	});
	}
</script>
<style type="text/css">
	#more_domains{
		cursor: pointer;
		float: right;
		border-bottom: 1px dashed white;
		font-size: 18px;
		font-weight: bold;
	}
	#ukr_domains,
	#world_domains{
		display: none;
	}
	#ukr_domains p,
	#world_domains p{
		border-top: 1px dashed #1B395C;
		font-weight: bold;
		padding-top: 5px;
	}
	#ukr_domains td,
	#world_domains td{
		vertical-align: top;
	}
	#container{
		background-color: #1A5AA2;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		border-radius: 5px;
		padding: 5px;
		width: 750px;
	}
	#container table{
		color: white;
		font-family: "Arial,Helvetica,sans-serif;";
		font-size: 14px;
	}
	#container table:first-child{
		width: 100%;
	}
	#domain_name{
		width: 250px;
		padding: 5px;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		border-radius: 5px;
		border: 1px solid #cccccc;
	}
	#zaglav{
		font-size: 16px;
	}
	#check{
		padding: 5px 10px 5px 10px;
		background-color: #ff9002;
		border: 1px solid #E07E00;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		border-radius: 5px;
		cursor: pointer;
		color: #804800;
	}
	#domains_result{
		border: 1px solid #cccccc;
		width: 400px;
	}
	#domains_result td{
		padding: 10px;
	}
</style>
<form action="checkDomain.html" method="POST" target="_blank">
	<div id="container">
		<table>
			<tr>
				<td align="center">
					<p id="zaglav">Проверка доменного имени</p>
					<p><input type="text" id="domain_name" name="domain_name"></p>
					<p><input type="submit" value="Проверить" id="check"></p>
				</td>
				<td>
					<table>
						<tr>
							<td>
								<input type="checkbox" name="ua" checked="checked" class="domain" id="dom_1"><label for="ua">.ua - 345 грн.</label><br>
								<input type="checkbox" name="com.ua" checked="checked" class="domain" id="dom_2"><label for="com.ua">.com.ua - 68 грн.</label><br>
								<input type="checkbox" name="kiev.ua" checked="checked" class="domain" id="dom_3"><label for="kiev.ua">.kiev.ua - 60 грн.</label><br>
							</td>
							<td>
								<input type="checkbox" name="com" checked="checked" class="domain" id="dom_4"><label for="com">.com - 110 грн.</label><br>
								<input type="checkbox" name="net" checked="checked" class="domain" id="dom_5"><label for="net">.net - 110 грн.</label><br>
								<input type="checkbox" name="org.ua" checked="checked" class="domain" id="dom_6"><label for="org.ua">.org.ua - 80 грн.</label><br>
							</td>
							<td>
								<input type="checkbox" name="net.ua" checked="checked" class="domain" id="dom_7"><label for="net.ua">.net.ua - 40 грн.</label><br>
								<input type="checkbox" name="in.ua" checked="checked" class="domain" id="dom_8"><label for="in.ua">.in.ua - 48 грн.</label><br>
								<input type="checkbox" name="ru" checked="checked" class="domain" id="dom_9"><label for="ru">.ru - 80 грн.</label><br>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div id="ukr_domains">
					<p>Украинские региональные домены <input type="checkbox" onClick="toggleUkr()" id="urk"></p>
					<table width="100%">
						<tr>
							<td>
								<input type="checkbox" name="cherkassy.ua" class="ukr" id="dom_10"><label for="cherkassy.ua">.cherkassy.ua - 68 грн.</label><br>
								<input type="checkbox" name="chernovtsy.ua" class="ukr" id="dom_11"><label for="chernovtsy.ua">.chernovtsy.ua - 80 грн.</label><br>
								<input type="checkbox" name="ck.ua" class="ukr" id="dom_12"><label for="ck.ua">.ck.ua - 68 грн.</label><br>
								<input type="checkbox" name="cn.ua" class="ukr" id="dom_13"><label for="cn.ua">.cn.ua - 100 грн.</label><br>
								<input type="checkbox" name="crimea.ua" class="ukr" id="dom_14"><label for="crimea.ua">.crimea.ua - 68 грн.</label><br>
								<input type="checkbox" name="cv.ua" class="ukr" id="dom_15"><label for="cv.ua">.cv.ua - 80 грн.</label><br>
								<input type="checkbox" name="dn.ua" class="ukr" id="dom_16"><label for="dn.ua">.dn.ua - 68 грн.</label><br>
								<input type="checkbox" name="donetsk.ua" class="ukr" id="dom_17"><label for="donetsk.ua">.donetsk.ua - 68 грн.</label><br>
								<input type="checkbox" name="dp.ua" class="ukr" id="dom_18"><label for="dp.ua">.dp.ua - 68 грн.</label><br>
								<input type="checkbox" name="if.ua" class="ukr" id="dom_19"><label for="if.ua">.if.ua - 80 грн.</label><br>
								<input type="checkbox" name="ivano-frankivsk.ua" class="ukr" id="dom_20"><label for="ivano-frankivsk.ua">.ivano-frankivsk.ua - 80 грн.</label><br>
								<input type="checkbox" name="kh.ua" class="ukr" id="dom_21"><label for="kh.ua">.kh.ua - 68 грн.</label><br>
							</td>
							<td>
								<input type="checkbox" name="kharkov.ua" class="ukr" id="dom_22"><label for="kharkov.ua">.kharkov.ua - 68 грн.</label><br>
								<input type="checkbox" name="kherson.ua" class="ukr" id="dom_23"><label for="kherson.ua">.kherson.ua - 80 грн.</label><br>
								<input type="checkbox" name="kirovograd.ua" class="ukr" id="dom_24"><label for="kirovograd.ua">.kirovograd.ua - 68 грн.</label><br>
								<input type="checkbox" name="km.ua" class="ukr" id="dom_25"><label for="km.ua">.km.ua - 80 грн.</label><br>
								<input type="checkbox" name="kr.ua" class="ukr" id="dom_26"><label for="kr.ua">.kr.ua - 90 грн.</label><br>
								<input type="checkbox" name="ks.ua" class="ukr" id="dom_27"><label for="ks.ua">.ks.ua - 80 грн.</label><br>
								<input type="checkbox" name="lg.ua" class="ukr" id="dom_28"><label for="lg.ua">.lg.ua - 68 грн.</label><br>
								<input type="checkbox" name="lugansk.ua" class="ukr" id="dom_29"><label for="lugansk.ua">.lugansk.ua - 68 грн.</label><br>
								<input type="checkbox" name="lutsk.ua" class="ukr" id="dom_30"><label for="lutsk.ua">.lutsk.ua - 51 грн.</label><br>
								<input type="checkbox" name="lviv.ua" class="ukr" id="dom_31"><label for="lviv.ua">.lviv.ua - 85 грн.</label><br>
								<input type="checkbox" name="mk.ua" class="ukr" id="dom_32"><label for="mk.ua">.mk.ua - 75 грн.</label><br>
								<input type="checkbox" name="nikolaev.ua" class="ukr" id="dom_33"><label for="nikolaev.ua">.nikolaev.ua - 75 грн.</label><br>
							</td>
							<td>
								<input type="checkbox" name="od.ua" class="ukr" id="dom_34"><label for="od.ua">.od.ua - 65 грн.</label><br>
								<input type="checkbox" name="odessa.ua" class="ukr" id="dom_35"><label for="odessa.ua">.odessa.ua - 65 грн.</label><br>
								<input type="checkbox" name="pl.ua" class="ukr" id="dom_36"><label for="pl.ua">.pl.ua - 51 грн.</label><br>
								<input type="checkbox" name="poltava.ua" class="ukr" id="dom_37"><label for="poltava.ua">.poltava.ua - 51 грн.</label><br>
								<input type="checkbox" name="rovno.ua" class="ukr" id="dom_38"><label for="rovno.ua">.rovno.ua - 51 грн.</label><br>
								<input type="checkbox" name="rv.ua" class="ukr" id="dom_39"><label for="rv.ua">.rv.ua - 51 грн.</label><br>
								<input type="checkbox" name="sebastopol.ua" class="ukr" id="dom_40"><label for="sebastopol.ua">.sebastopol.ua - 68 грн.</label><br>
								<input type="checkbox" name="sumy.ua" class="ukr" id="dom_41"><label for="sumy.ua">.sumy.ua - 60 грн.</label><br>
								<input type="checkbox" name="te.ua" class="ukr" id="dom_42"><label for="te.ua">.te.ua - 80 грн.</label><br>
								<input type="checkbox" name="ternopil.ua" class="ukr" id="dom_43"><label for="ternopil.ua">.ternopil.ua - 80 грн.</label><br>
								<input type="checkbox" name="uz.ua" class="ukr" id="dom_44"><label for="uz.ua">.uz.ua - 80 грн.</label><br>
								<input type="checkbox" name="uzhgorod.ua" class="ukr" id="dom_45"><label for="uzhgorod.ua">.uzhgorod.ua - 80 грн.</label><br>
							</td>
							<td>
								<input type="checkbox" name="vinnica.ua" class="ukr" id="dom_46"><label for="vinnica.ua">.vinnica.ua - 51 грн.</label><br>
								<input type="checkbox" name="vn.ua" class="ukr" id="dom_47"><label for="vn.ua">.vn.ua - 51 грн.</label><br>
								<input type="checkbox" name="zaporizhzhe.ua" class="ukr" id="dom_48"><label for="zaporizhzhe.ua">.zaporizhzhe.ua - 68 грн.</label><br>
								<input type="checkbox" name="zhitomir.ua" class="ukr" id="dom_49"><label for="zhitomir.ua">.zhitomir.ua - 90 грн.</label><br>
								<input type="checkbox" name="zp.ua" class="ukr" id="dom_50"><label for="zp.ua">.zp.ua - 68 грн.</label><br>
								<input type="checkbox" name="zt.ua" class="ukr" id="dom_51"><label for="zt.ua">.zt.ua - 90 грн.</label><br>
								<input type="checkbox" name="gov.ua" class="ukr" id="dom_52"><label for="gov.ua">.gov.ua - 110 грн.</label><br>
								<input type="checkbox" name="edu.ua" class="ukr" id="dom_53"><label for="edu.ua">.edu.ua - 110 грн.</label><br>
								<input type="checkbox" name="kharkiv.ua" class="ukr" id="dom_54"><label for="kharkiv.ua">.kharkiv.ua - 68 грн.</label><br>
							</td>
						</tr>
					</table>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div id="world_domains">
					<p>Международные домены <input type="checkbox" id="world" onClick="toggleWorld()"></p>
					<table width="100%">
						<tr>
							<td>
								<input type="checkbox" name="info" class="world" id="dom_55"><label for="info">.info - 110 грн.</label><br>
								<input type="checkbox" name="name" class="world" id="dom_56"><label for="name">.name - 110 грн.</label><br>
							</td>
							<td>
								<input type="checkbox" name="org" class="world" id="dom_57"><label for="org">.org - 110 грн.</label><br>
								<input type="checkbox" name="yalta.ua" class="world" id="dom_58"><label for="yalta.ua">.yalta.ua - 68 грн.</label><br>
							</td>
							<td>
								<input type="checkbox" name="рф" class="world" id="dom_59"><label for="рф">.рф - 80 грн.</label><br>
								<input type="checkbox" name="de" class="world" id="dom_60"><label for="de">.de - 190 грн.</label><br>
							</td>
							<td>
								<input type="checkbox" name="biz" class="world" id="dom_61"><label for="biz">.biz - 110 грн.</label><br>
							</td>
						</tr>
					</table>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="right">
					<div id="more_domains">Больше доменов</div>
				</td>
			</tr>
		</table>
	</div>
</form>
<table id="domains_result"></table>