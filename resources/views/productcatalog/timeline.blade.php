
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rowca : product catalog</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>
	
		<!--script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-93762417-3', 'auto');
  ga('send', 'pageview');

	</script-->
	
	<!-- SOCIAL MEDIA -->
	<!-- 
	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:site" content="@OCHAROWCA" />
	<meta name="twitter:creator" content="@OCHAROWCA" />
	<meta property="og:url" content="https://weekly-wca.unocha.org" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Weekly Regional Humanitarian Snapshot database" />
	<meta property="og:description" content="Weekly Regional Humanitarian Snapshot database for West and Central Africa" />
	<meta property="og:image" content="https://rowca.egnyte.com/dd/j508lKOUpx/?thumbNail=1&w=1200&h=1200&type=proportional&preview=true" />
	 -->
	



    <!-- CSS-->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('ionIcons/css/ionicons.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/css_1.3.css') }}"/>
	<link rel="stylesheet" href="{{ asset('glyphsOcha/style.css') }}"/>
	
	<!-- JQUERY UI -->
	<script src="{{ asset('js/jquery.js') }}"></script>
</head>
<body>
	<script>
	function ShowHideProduct(){
		id=$(this).attr("id");
		$("#"+id+" .productContent").slideToggle(300);
		
	}
	

	var id = 0;
	var products = null;
	var spreadsheetId = "18Ab2IBBdvVM2v7fHTcb-D0CjLy0qLPHiIy_1M2eLntc",
    url = "https://spreadsheets.google.com/feeds/list/" +
          spreadsheetId +
          "/od6/public/basic?alt=json";
	$.get({
	  url: url,
	  success: function(response) {
		

		//GETTING THE DATAS
		var data = response.feed.entry,
		len = data.length,
		i = 0,
		parsedData = [];


		
		for (i = 0; i < len; i++) {
		  parsedData.push({
			label: data[i].title.$t,
			value: data[i].content.$t.replace('Income: ', '')
		  });
		}
		
		//SHOWING THE DATA
		var months = ["jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec",];
		var pID = 0;
		for (i = 0; i < parsedData.length; i++) {
		
			var productInfo = parsedData[i].value.split(",");
			
			var occurence = productInfo[2].split(":")[1].trim();
			var trigger = productInfo[4].split(":")[1].trim();
			var link = productInfo[15].split(":")[1];
			var previewImageName = ""
			
			var output = "";
			
			
			if(productInfo[14]!=undefined){
				link = productInfo[14].replace("porductdistributionlink: ", "").trim();
				link = link.trim();
				if(link!="NA"){
					link = "<a href='"+link+"' target='_blank'><span class='glyphicon glyphicon-link lienDocument'></span></a>";
				
				}else{
					link = "";
				}
			}else{
				link = "";
			}

			
		
			if(productInfo[15]!=undefined){
				previewImageName = productInfo[15].split(":")[1];
				if(previewImageName!=undefined){
					previewImageName = previewImageName.trim();
				}else{
					previewImageName = "";
				}
			}else{
				previewImageName = "";
			}
			
			if(productInfo[12]!=undefined){
				var output = productInfo[12].split(":")[1].trim();
			}
			
			var pcrResponsabilities = productInfo[6].split(":")[1];
			if(pcrResponsabilities!=undefined){
				pcrResponsabilities = pcrResponsabilities.trim();
				
				if(pcrResponsabilities=="NA"){
					pcrResponsabilities = "";
				}else{
				
					pcrResponsabilities = "<div class='productResponsibleLine'><div class='productResponsibleUnit PCR'>PCR</div><div class='productResponsibleTask'>"+productInfo[6].split(":")[1].trim()+"</div></div>";
				}
			}else{
				pcrResponsabilities = "";
			}
			
			var imResponsabilities = productInfo[7].split(":")[1];
			if(imResponsabilities!=undefined){
				imResponsabilities = imResponsabilities.trim();
				
				if(imResponsabilities=="NA"){
					imResponsabilities = "";
				}else{
					imResponsabilities = "<div class='productResponsibleLine'><div class='productResponsibleUnit IM'>IM</div><div class='productResponsibleTask'>"+productInfo[7].split(":")[1].trim()+"</div></div>";
				}
			}else{
				imResponsabilities = "";
			}
			
			
			
			var piResponsabilities = productInfo[8].split(":")[1];
			if(piResponsabilities!=undefined){
				piResponsabilities = piResponsabilities.trim();
				
				if(piResponsabilities=="NA"){
					piResponsabilities = "";
				}else{
					piResponsabilities = "<div class='productResponsibleLine'><div class='productResponsibleUnit PI'>PI</div><div class='productResponsibleTask'>"+productInfo[8].split(":")[1].trim()+"</div></div>";
				}
			}else{
				piResponsabilities = "";
			}
			
			
			
			
			var product = parsedData[i].label.trim();
			var imagePreview = "";
			var classContent = "";
			if(previewImageName!="NA"){
				imagePreview = "<div class='preview'><img src='images/"+previewImageName+".jpg'/></div>";
				classContent ="Calc";
			}
				
				
			if(occurence=="Ad hoc"){
				
				
				$("#anytime").append("<div class='product' id='product"+pID+"'><div class='entete'><div class='productOccurence2'><span class='ion-flash'></span></div><div class='productTitle'>"+product+"</div></div><div class='productContent'  hidden='hidden' >"+imagePreview+"<div class='contents"+classContent+"'><div class='productTrigger'><span class='ion-arrow-graph-up-right'></span> Trigger : "+trigger+"</div><div class='productResponsibles'>"+pcrResponsabilities+imResponsabilities+piResponsabilities+"</div><div class='productOutput'>Distribution platform : "+output+" "+link+"</div></div></div></div>");
				
				id = "product"+pID;
				productEvent = document.getElementById(id);
				if(productEvent!=null){
					productEvent.addEventListener("click", ShowHideProduct);
				}
				pID++;

			}else{
				//var monthArray = productInfo[5].split(":")[1].split("-")[1].trim();
				var monthArray = productInfo[5].split(":")[1].split("-");
				
				switch(occurence) {
					case "Bi-monthly":
						for (j = 0; j < months.length; j++) {
							
							$("#"+months[j]+" .ProductMonth").append("<div class='product' id='product"+pID+"'><div class='entete'><div class='productOccurence'>"+occurence+"</div><div class='productTitle'>"+product+"</div></div><div class='productContent'  hidden='hidden' >"+imagePreview+"<div class='contents"+classContent+"'><div class='productTrigger'><span class='ion-arrow-graph-up-right'></span> Trigger : "+trigger+"</div><div class='productResponsibles'>"+pcrResponsabilities+imResponsabilities+piResponsabilities+"</div><div class='productOutput'>Distribution platform : "+output+" "+link+"</div></div></div></div>");
							
							id = "product"+pID;
							productEvent = document.getElementById(id);
							if(productEvent!=null){
								productEvent.addEventListener("click", ShowHideProduct);
							}
							pID++;
						}
						break;
					case "Daily":
						for (j = 0; j < months.length; j++) {
							$("#"+months[j]+" .ProductMonth").append("<div class='product' id='product"+pID+"'><div class='entete'><div class='productOccurence'>"+occurence+"</div><div class='productTitle'>"+product+"</div></div><div class='productContent'  hidden='hidden' >"+imagePreview+"<div class='contents"+classContent+"'><div class='productTrigger'><span class='ion-arrow-graph-up-right'></span> Trigger : "+trigger+"</div><div class='productResponsibles'>"+pcrResponsabilities+imResponsabilities+piResponsabilities+"</div><div class='productOutput'>Distribution platform : "+output+" "+link+"</div></div></div></div>");
							
							id = "product"+pID;
							productEvent = document.getElementById(id);
							if(productEvent!=null){
								productEvent.addEventListener("click", ShowHideProduct);
							}
							pID++;
						}
						break;
					case "Bi-annual":
						
						var monthArray = productInfo[5].split(":")[1].split("-");
						var monthsExists = false;
						if(monthArray.length!=0)
						{
							for (k = 0; k < monthArray.length; k++) {
								
								if(months.indexOf(monthArray[k].trim())!=-1){
									////console.log(product+" trouve");
									$("#"+monthArray[k].trim()+" .ProductMonth").append("<div class='product' id='product"+pID+"'><div class='entete'><div class='productOccurence'>"+occurence+"</div><div class='productTitle'>"+product+"</div></div><div class='productContent'  hidden='hidden' >"+imagePreview+"<div class='contents"+classContent+"'><div class='productTrigger'><span class='ion-arrow-graph-up-right'></span> Trigger : "+trigger+"</div><div class='productResponsibles'>"+pcrResponsabilities+imResponsabilities+piResponsabilities+"</div><div class='productOutput'>Distribution platform : "+output+" "+link+"</div></div></div></div>");
								
									id = "product"+pID;
									productEvent = document.getElementById(id);
									if(productEvent!=null){
										productEvent.addEventListener("click", ShowHideProduct);
									}
									pID++;
									monthsExists = true;
								}else{
									////console.log("pas trouve");
								}
							}
						}

						////console.log(monthArray);

						if(!monthsExists){
							for (j = 0; j < months.length; j+=6) {
								$("#"+months[j]+" .ProductMonth").append("<div class='product' id='product"+pID+"'><div class='entete'><div class='productOccurence'>"+occurence+"</div><div class='productTitle'>"+product+"</div></div><div class='productContent'  hidden='hidden' >"+imagePreview+"<div class='contents"+classContent+"'><div class='productTrigger'><span class='ion-arrow-graph-up-right'></span> Trigger : "+trigger+"</div><div class='productResponsibles'>"+pcrResponsabilities+imResponsabilities+piResponsabilities+"</div><div class='productOutput'>Distribution platform : "+output+" "+link+"</div></div></div></div>");
								
								id = "product"+pID;
								productEvent = document.getElementById(id);
								if(productEvent!=null){
									productEvent.addEventListener("click", ShowHideProduct);
								}
								pID++;
							}
						}
						
						break;
					case "Annual":

						var monthArray = productInfo[5].split(":")[1].split("-");
						var monthsExists = false;
						if(monthArray.length!=0)
						{
							for (k = 0; k < monthArray.length; k++) {
								
								if(months.indexOf(monthArray[k].trim())!=-1){
									//console.log(product+" trouve");
									$("#"+monthArray[k].trim()+" .ProductMonth").append("<div class='product' id='product"+pID+"'><div class='entete'><div class='productOccurence'>"+occurence+"</div><div class='productTitle'>"+product+"</div></div><div class='productContent'  hidden='hidden' >"+imagePreview+"<div class='contents"+classContent+"'><div class='productTrigger'><span class='ion-arrow-graph-up-right'></span> Trigger : "+trigger+"</div><div class='productResponsibles'>"+pcrResponsabilities+imResponsabilities+piResponsabilities+"</div><div class='productOutput'>Distribution platform : "+output+" "+link+"</div></div></div></div>");
								
									id = "product"+pID;
									productEvent = document.getElementById(id);
									if(productEvent!=null){
										productEvent.addEventListener("click", ShowHideProduct);
									}
									pID++;
									monthsExists = true;
								}else{
									//console.log("pas trouve");
								}
							}
						}

						//console.log(monthArray);

						if(!monthsExists){
							for (j = 0; j < months.length; j+=12) {
								$("#"+months[j]+" .ProductMonth").append("<div class='product' id='product"+pID+"'><div class='entete'><div class='productOccurence'>"+occurence+"</div><div class='productTitle'>"+product+"</div></div><div class='productContent'  hidden='hidden' >"+imagePreview+"<div class='contents"+classContent+"'><div class='productTrigger'><span class='ion-arrow-graph-up-right'></span> Trigger : "+trigger+"</div><div class='productResponsibles'>"+pcrResponsabilities+imResponsabilities+piResponsabilities+"</div><div class='productOutput'>Distribution platform : "+output+" "+link+"</div></div></div></div>");
								
								id = "product"+pID;
								productEvent = document.getElementById(id);
								if(productEvent!=null){
									productEvent.addEventListener("click", ShowHideProduct);
								}
								pID++;
							}
						}
						break;
					case "Quarterly":

					var monthArray = productInfo[5].split(":")[1].split("-");
						var monthsExists = false;
						if(monthArray.length!=0)
						{
							for (k = 0; k < monthArray.length; k++) {
								
								if(months.indexOf(monthArray[k].trim())!=-1){
									//console.log(product+" trouve");
									$("#"+monthArray[k].trim()+" .ProductMonth").append("<div class='product' id='product"+pID+"'><div class='entete'><div class='productOccurence'>"+occurence+"</div><div class='productTitle'>"+product+"</div></div><div class='productContent'  hidden='hidden' >"+imagePreview+"<div class='contents"+classContent+"'><div class='productTrigger'><span class='ion-arrow-graph-up-right'></span> Trigger : "+trigger+"</div><div class='productResponsibles'>"+pcrResponsabilities+imResponsabilities+piResponsabilities+"</div><div class='productOutput'>Distribution platform : "+output+" "+link+"</div></div></div></div>");
								
									id = "product"+pID;
									productEvent = document.getElementById(id);
									if(productEvent!=null){
										productEvent.addEventListener("click", ShowHideProduct);
									}
									pID++;
									monthsExists = true;
								}else{
									//console.log("pas trouve");
								}
							}
						}

						//console.log(monthArray);

						if(!monthsExists){
							for (j = 0; j < months.length; j+=4) {
								$("#"+months[j]+" .ProductMonth").append("<div class='product' id='product"+pID+"'><div class='entete'><div class='productOccurence'>"+occurence+"</div><div class='productTitle'>"+product+"</div></div><div class='productContent'  hidden='hidden' >"+imagePreview+"<div class='contents"+classContent+"'><div class='productTrigger'><span class='ion-arrow-graph-up-right'></span> Trigger : "+trigger+"</div><div class='productResponsibles'>"+pcrResponsabilities+imResponsabilities+piResponsabilities+"</div><div class='productOutput'>Distribution platform : "+output+" "+link+"</div></div></div></div>");
								
								id = "product"+pID;
								productEvent = document.getElementById(id);
								if(productEvent!=null){
									productEvent.addEventListener("click", ShowHideProduct);
								}
								pID++;
							}
						}
						break;
					case "Monthly":
						for (j = 0; j < months.length; j++) {
							$("#"+months[j]+" .ProductMonth").append("<div class='product' id='product"+pID+"'><div class='entete'><div class='productOccurence'>"+occurence+"</div><div class='productTitle'>"+product+"</div></div><div class='productContent'  hidden='hidden' >"+imagePreview+"<div class='contents"+classContent+"'><div class='productTrigger'><span class='ion-arrow-graph-up-right'></span> Trigger : "+trigger+"</div><div class='productResponsibles'>"+pcrResponsabilities+imResponsabilities+piResponsabilities+"</div><div class='productOutput'>Distribution platform : "+output+" "+link+"</div></div></div></div>");
							
							id = "product"+pID;
							productEvent = document.getElementById(id);
							if(productEvent!=null){
								productEvent.addEventListener("click", ShowHideProduct);
							}
							pID++;
						}
						break;
					case "Weekly":
						for (j = 0; j < months.length; j++) {
							$("#"+months[j]+" .ProductMonth").append("<div class='product' id='product"+pID+"'><div class='entete'><div class='productOccurence'>"+occurence+"</div><div class='productTitle'>"+product+"</div></div><div class='productContent'  hidden='hidden' >"+imagePreview+"<div class='contents"+classContent+"'><div class='productTrigger'><span class='ion-arrow-graph-up-right'></span> Trigger : "+trigger+"</div><div class='productResponsibles'>"+pcrResponsabilities+imResponsabilities+piResponsabilities+"</div><div class='productOutput'>Distribution platform : "+output+" "+link+"</div></div></div></div>");
							
							id = "product"+pID;
							productEvent = document.getElementById(id);
							if(productEvent!=null){
								productEvent.addEventListener("click", ShowHideProduct);

							}
							pID++;
						}
						break;
					default:
						
						break;
				}
				
				
				
				
				

				
				
				
			}	
			
				
		}
		;

	  }
	})
  .fail(function() {
    alert( "An error occured Contact the Administrator or check your internet connexion" );
  })
 ;
	
	</script>

	<div class="container-fluid">
		<div class='row'>
			<div id ='anytimeproduct' class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>
				<div class='rowTitle2 col-xs-12 col-sm-12 col-md-12 col-lg-12'>
					<span class='ion-flash'></span> ANYTIME PRODUCTS
				</div>
				<div class='anytime col-xs-12 col-sm-12 col-md-12 col-lg-12' style='margin-top:63px;' id='anytime'>

				</div>
				<div class='bottom'>
					<span class='icon-logoOcha logo'></span><br/>
					<span class='titreDocument'>Information Product and Service Catalogue</span>
				</div>
				
			</div>
			<div id ='scheduledproduct' class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>
				<div class='rowTitle col-xs-12 col-sm-12 col-md-12 col-lg-12'>
					<span class='ion-ios-calendar-outline'></span> SCHEDULED PRODUCTS
				</div>
				<div class='month col-xs-12 col-sm-12 col-md-12 col-lg-12' style='margin-top:63px;' id='jan'>
					<div class='labelMonth col-xs-3 col-sm-3 col-md-3 col-lg-3'>JAN</div>
					<div class='ProductMonth col-xs-9 col-sm-9 col-md-9 col-lg-9'>
						
					</div>
				</div>
				<div class='monthStripped col-xs-12 col-sm-12 col-md-12 col-lg-12' id='feb'>
					<div class='labelMonth col-xs-3 col-sm-3 col-md-3 col-lg-3'>FEB</div>
					<div class='ProductMonth col-xs-9 col-sm-9 col-md-9 col-lg-9 '>
						
					</div>
				</div>
				<div class='month col-xs-12 col-sm-12 col-md-12 col-lg-12' id='mar'>
					<div class='labelMonth col-xs-3 col-sm-3 col-md-3 col-lg-3'>MAR</div>
					<div class='ProductMonth col-xs-9 col-sm-9 col-md-9 col-lg-9'>
						
					</div>
				</div>
				<div class='monthStripped col-xs-12 col-sm-12 col-md-12 col-lg-12' id='apr'>
					<div class='labelMonth col-xs-3 col-sm-3 col-md-3 col-lg-3'>APR</div>
					<div class='ProductMonth col-xs-9 col-sm-9 col-md-9 col-lg-9'>
						
					</div>
				</div>
				<div class='month col-xs-12 col-sm-12 col-md-12 col-lg-12' id='may'>
					<div class='labelMonth col-xs-3 col-sm-3 col-md-3 col-lg-3'>MAY</div>
					<div class='ProductMonth col-xs-9 col-sm-9 col-md-9 col-lg-9'>
						
					</div>
				</div>
				<div class='monthStripped col-xs-12 col-sm-12 col-md-12 col-lg-12' id='jun'>
					<div class='labelMonth col-xs-3 col-sm-3 col-md-3 col-lg-3'>JUN</div>
					<div class='ProductMonth col-xs-9 col-sm-9 col-md-9 col-lg-9'>
						
					</div>
				</div>
				<div class='month col-xs-12 col-sm-12 col-md-12 col-lg-12' id='jul'>
					<div class='labelMonth col-xs-3 col-sm-3 col-md-3 col-lg-3'>JUL</div>
					<div class='ProductMonth col-xs-9 col-sm-9 col-md-9 col-lg-9'>
						
					</div>
				</div>
				<div class='monthStripped col-xs-12 col-sm-12 col-md-12 col-lg-12' id='aug'>
					<div class='labelMonth col-xs-3 col-sm-3 col-md-3 col-lg-3'>AUG</div>
					<div class='ProductMonth col-xs-9 col-sm-9 col-md-9 col-lg-9'>
						
					</div>
				</div>
				<div class='month col-xs-12 col-sm-12 col-md-12 col-lg-12' id='sep'>
					<div class='labelMonth col-xs-3 col-sm-3 col-md-3 col-lg-3'>SEP</div>
					<div class='ProductMonth col-xs-9 col-sm-9 col-md-9 col-lg-9'>
						
					</div>
				</div>
				<div class='monthStripped col-xs-12 col-sm-12 col-md-12 col-lg-12' id='oct'>
					<div class='labelMonth col-xs-3 col-sm-3 col-md-3 col-lg-3'>OCT</div>
					<div class='ProductMonth col-xs-9 col-sm-9 col-md-9 col-lg-9'>
						
					</div>
				</div>
				<div class='month col-xs-12 col-sm-12 col-md-12 col-lg-12' id='nov'>
					<div class='labelMonth col-xs-3 col-sm-3 col-md-3 col-lg-3'>NOV</div>
					<div class='ProductMonth col-xs-9 col-sm-9 col-md-9 col-lg-9'>
						
					</div>
				</div>
				<div class='monthStripped col-xs-12 col-sm-12 col-md-12 col-lg-12' id='dec'>
					<div class='labelMonth col-xs-3 col-sm-3 col-md-3 col-lg-3'>DEC</div>
					<div class='ProductMonth col-xs-9 col-sm-9 col-md-9 col-lg-9'>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script src="{{ asset('js/jsscript_10.js') }}"></script>
</body>
</html>