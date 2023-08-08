// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("gka-show") == -1) {
        x.className += " gka-show";
        x.previousElementSibling.className += " gka-theme-d1";
    } else { 
        x.className = x.className.replace("gka-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" gka-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("gka-show") == -1) {
        x.className += " gka-show";
    } else { 
        x.className = x.className.replace(" gka-show", "");
    }
}

function viewMore(){
//alert(window.location); 
window.parent.location.href="Questionnaire/gka_viewAll.html";
}

function editQuestionnaire_Cancel(){
confirm('You will loose out last change done, Are you Sure?');
window.parent.location.href="gka_viewAll.html";
}

function selChgType() {
//values of Dropdown at create new  questionnaire : 
/*selVal_Add, selVal_Subt, selVal_Multp, selVal_Dvsn, 
Fill in the blanks : selVal_FitbText, selVal_FitbImg, 
Match the Following : selVal_MtFText, selVal_MtFImg, 
Multiple Choice : selVal_MCQText, selVal_MCQImg_TXT, selVal_MCQImg, selVal_MCQTF, selVal_MCQ_TFImg*/

//Div Name :
/*AddtnContent, SubtrnContent, MultpnContent, DvsnContent, 
Fill in the blanks : FitbContent_text, FitbContent_Img, 
Match the Following : MtFContent_text, MtFContent_Img, 
Multiple Choice : McQContent_Txt, McQContent_Img, McQCnt_ImgeTxt, McQCnt_TF, McQCnt_TFImg*/
    var x = document.getElementById("myQuestionType").value; 
	if(x == 'selVal_Add'){
	document.getElementById('AddtnContent').style.display = "block";
	document.getElementById('SubtrnContent').style.display = "none";
	document.getElementById('MultpnContent').style.display = "none";
	document.getElementById('DvsnContent').style.display = "none"; 
    document.getElementById('FitbContent_text').style.display = "none";	
    document.getElementById('FitbContent_Img').style.display = "none";
	document.getElementById('MtFContent_text').style.display = "none";	
    document.getElementById('MtFContent_Img').style.display = "none"; 
	document.getElementById('McQContent_Txt').style.display = "none";//selVal_MCQText  
	document.getElementById('McQContent_Img').style.display = "none"; //selVal_MCQImg
	document.getElementById('McQCnt_ImgeTxt').style.display = "none";//selVal_MCQImg_TXT
	document.getElementById('McQCnt_TF').style.display = "none";//selVal_MCQTF
	document.getElementById('McQCnt_TFImg').style.display = "none";//selVal_MCQ_TFImg			
	}
	if(x == 'selVal_Subt'){
	document.getElementById('AddtnContent').style.display = "none";
	document.getElementById('SubtrnContent').style.display = "block";
	document.getElementById('MultpnContent').style.display = "none";
	document.getElementById('DvsnContent').style.display = "none"; 
    document.getElementById('FitbContent_text').style.display = "none";	
    document.getElementById('FitbContent_Img').style.display = "none";
	document.getElementById('MtFContent_text').style.display = "none";	
    document.getElementById('MtFContent_Img').style.display = "none"; 
	document.getElementById('McQContent').style.display = "none";
	document.getElementById('McQContent_Txt').style.display = "none";//selVal_MCQText  
	document.getElementById('McQContent_Img').style.display = "none"; //selVal_MCQImg
	document.getElementById('McQCnt_ImgeTxt').style.display = "none";//selVal_MCQImg_TXT
	document.getElementById('McQCnt_TF').style.display = "none";//selVal_MCQTF
	document.getElementById('McQCnt_TFImg').style.display = "none";//selVal_MCQ_TFImg
	}
	if(x == 'selVal_Multp'){
	document.getElementById('AddtnContent').style.display = "none";
	document.getElementById('SubtrnContent').style.display = "none";
	document.getElementById('MultpnContent').style.display = "block";
	document.getElementById('DvsnContent').style.display = "none"; 
    document.getElementById('FitbContent_text').style.display = "none";	
    document.getElementById('FitbContent_Img').style.display = "none";
	document.getElementById('MtFContent_text').style.display = "none";	
    document.getElementById('MtFContent_Img').style.display = "none"; 
	document.getElementById('McQContent_Txt').style.display = "none";//selVal_MCQText  
	document.getElementById('McQContent_Img').style.display = "none"; //selVal_MCQImg
	document.getElementById('McQCnt_ImgeTxt').style.display = "none";//selVal_MCQImg_TXT
	document.getElementById('McQCnt_TF').style.display = "none";//selVal_MCQTF
	document.getElementById('McQCnt_TFImg').style.display = "none";//selVal_MCQ_TFImg
	}
	if(x == 'selVal_Dvsn'){
	document.getElementById('AddtnContent').style.display = "none";
	document.getElementById('SubtrnContent').style.display = "none";
	document.getElementById('MultpnContent').style.display = "none";
	document.getElementById('DvsnContent').style.display = "block"; 
    document.getElementById('FitbContent_text').style.display = "none";	
    document.getElementById('FitbContent_Img').style.display = "none";
	document.getElementById('MtFContent_text').style.display = "none";	
    document.getElementById('MtFContent_Img').style.display = "none";  
	document.getElementById('McQContent_Txt').style.display = "none";//selVal_MCQText  
	document.getElementById('McQContent_Img').style.display = "none"; //selVal_MCQImg
	document.getElementById('McQCnt_ImgeTxt').style.display = "none";//selVal_MCQImg_TXT
	document.getElementById('McQCnt_TF').style.display = "none";//selVal_MCQTF
	document.getElementById('McQCnt_TFImg').style.display = "none";//selVal_MCQ_TFImg
	}
    if(x == 'selVal_FitbText'){
	document.getElementById('AddtnContent').style.display = "none";
	document.getElementById('SubtrnContent').style.display = "none";
	document.getElementById('MultpnContent').style.display = "none";
	document.getElementById('DvsnContent').style.display = "none"; 
    document.getElementById('FitbContent_text').style.display = "block";	
    document.getElementById('FitbContent_Img').style.display = "none";
	document.getElementById('MtFContent_text').style.display = "none";	
    document.getElementById('MtFContent_Img').style.display = "none"; 
	
	document.getElementById('McQContent_Txt').style.display = "none";//selVal_MCQText  
	document.getElementById('McQContent_Img').style.display = "none"; //selVal_MCQImg
	document.getElementById('McQCnt_ImgeTxt').style.display = "none";//selVal_MCQImg_TXT
	document.getElementById('McQCnt_TF').style.display = "none";//selVal_MCQTF
	document.getElementById('McQCnt_TFImg').style.display = "none";//selVal_MCQ_TFImg
	}
	    if(x == 'selVal_FitbImg'){
	document.getElementById('AddtnContent').style.display = "none";
	document.getElementById('SubtrnContent').style.display = "none";
	document.getElementById('MultpnContent').style.display = "none";
	document.getElementById('DvsnContent').style.display = "none"; 
    document.getElementById('FitbContent_text').style.display = "none";
	document.getElementById('FitbContent_Img').style.display = "block";
	document.getElementById('MtFContent_text').style.display = "none";	
    document.getElementById('MtFContent_Img').style.display = "none"; 
	document.getElementById('McQContent_Txt').style.display = "none";//selVal_MCQText  
	document.getElementById('McQContent_Img').style.display = "none"; //selVal_MCQImg
	document.getElementById('McQCnt_ImgeTxt').style.display = "none";//selVal_MCQImg_TXT
	document.getElementById('McQCnt_TF').style.display = "none";//selVal_MCQTF
	document.getElementById('McQCnt_TFImg').style.display = "none";//selVal_MCQ_TFImg
	}
	if(x == 'selVal_MtFText'){
	document.getElementById('AddtnContent').style.display = "none";
	document.getElementById('SubtrnContent').style.display = "none";
	document.getElementById('MultpnContent').style.display = "none";
	document.getElementById('DvsnContent').style.display = "none";
    document.getElementById('FitbContent_text').style.display = "none";	
    document.getElementById('FitbContent_Img').style.display = "none";
	document.getElementById('MtFContent_text').style.display = "block";	
    document.getElementById('MtFContent_Img').style.display = "none"; 
	document.getElementById('McQContent_Txt').style.display = "none";//selVal_MCQText  
	document.getElementById('McQContent_Img').style.display = "none"; //selVal_MCQImg
	document.getElementById('McQCnt_ImgeTxt').style.display = "none";//selVal_MCQImg_TXT
	document.getElementById('McQCnt_TF').style.display = "none";//selVal_MCQTF
	document.getElementById('McQCnt_TFImg').style.display = "none";//selVal_MCQ_TFImg
	}
	if(x == 'selVal_MtFImg'){
	document.getElementById('AddtnContent').style.display = "none";
	document.getElementById('SubtrnContent').style.display = "none";
	document.getElementById('MultpnContent').style.display = "none";
	document.getElementById('DvsnContent').style.display = "none";
    document.getElementById('FitbContent_text').style.display = "none";	
    document.getElementById('FitbContent_Img').style.display = "none";
	document.getElementById('MtFContent_text').style.display = "none";	
    document.getElementById('MtFContent_Img').style.display = "block"; 
	document.getElementById('McQContent_Txt').style.display = "none";//selVal_MCQText  
	document.getElementById('McQContent_Img').style.display = "none"; //selVal_MCQImg
	document.getElementById('McQCnt_ImgeTxt').style.display = "none";//selVal_MCQImg_TXT
	document.getElementById('McQCnt_TF').style.display = "none";//selVal_MCQTF
	document.getElementById('McQCnt_TFImg').style.display = "none";//selVal_MCQ_TFImg
	}
	if(x == 'selVal_MCQText'){
	document.getElementById('AddtnContent').style.display = "none";
	document.getElementById('SubtrnContent').style.display = "none";
	document.getElementById('MultpnContent').style.display = "none";
	document.getElementById('DvsnContent').style.display = "none";
    document.getElementById('FitbContent_text').style.display = "none";	
    document.getElementById('FitbContent_Img').style.display = "none";
	document.getElementById('MtFContent_text').style.display = "none";	
    document.getElementById('MtFContent_Img').style.display = "none"; 
	document.getElementById('McQContent_Txt').style.display = "block";//selVal_MCQText  
	document.getElementById('McQContent_Img').style.display = "none"; //selVal_MCQImg
	document.getElementById('McQCnt_ImgeTxt').style.display = "none";//selVal_MCQImg_TXT
	document.getElementById('McQCnt_TF').style.display = "none";//selVal_MCQTF
	document.getElementById('McQCnt_TFImg').style.display = "none";//selVal_MCQ_TFImg
	}
	if(x == 'selVal_MCQImg'){
	//alert('dfdsfdsf');
	document.getElementById('AddtnContent').style.display = "none";
	document.getElementById('SubtrnContent').style.display = "none";
	document.getElementById('MultpnContent').style.display = "none";
	document.getElementById('DvsnContent').style.display = "none";
    document.getElementById('FitbContent_text').style.display = "none";	
    document.getElementById('FitbContent_Img').style.display = "none";
	document.getElementById('MtFContent_text').style.display = "none";	
    document.getElementById('MtFContent_Img').style.display = "none"; 
	document.getElementById('McQContent_Txt').style.display = "none";//selVal_MCQText  
	document.getElementById('McQContent_Img').style.display = "block"; //selVal_MCQImg
	document.getElementById('McQCnt_ImgeTxt').style.display = "none";//selVal_MCQImg_TXT
	document.getElementById('McQCnt_TF').style.display = "none";//selVal_MCQTF
	document.getElementById('McQCnt_TFImg').style.display = "none";//selVal_MCQ_TFImg
	}
	if(x == 'selVal_MCQ_ImgTXT'){ 
	document.getElementById('AddtnContent').style.display = "none";
	document.getElementById('SubtrnContent').style.display = "none";
	document.getElementById('MultpnContent').style.display = "none";
	document.getElementById('DvsnContent').style.display = "none";
    document.getElementById('FitbContent_text').style.display = "none";	
    document.getElementById('FitbContent_Img').style.display = "none";
	document.getElementById('MtFContent_text').style.display = "none";	
    document.getElementById('MtFContent_Img').style.display = "none"; 
	document.getElementById('McQContent_Txt').style.display = "none";//selVal_MCQText  
	document.getElementById('McQContent_Img').style.display = "none"; //selVal_MCQImg
	document.getElementById('McQCnt_ImgeTxt').style.display = "block";//selVal_MCQImg_TXT
	document.getElementById('McQCnt_TF').style.display = "none";//selVal_MCQTF
	document.getElementById('McQCnt_TFImg').style.display = "none";//selVal_MCQ_TFImg
	}
	if(x == 'selVal_MCQTF'){ 
	document.getElementById('AddtnContent').style.display = "none";
	document.getElementById('SubtrnContent').style.display = "none";
	document.getElementById('MultpnContent').style.display = "none";
	document.getElementById('DvsnContent').style.display = "none";
    document.getElementById('FitbContent_text').style.display = "none";	
    document.getElementById('FitbContent_Img').style.display = "none";
	document.getElementById('MtFContent_text').style.display = "none";	
    document.getElementById('MtFContent_Img').style.display = "none"; 
	document.getElementById('McQContent_Txt').style.display = "none";//selVal_MCQText  
	document.getElementById('McQContent_Img').style.display = "none"; //selVal_MCQImg
	document.getElementById('McQCnt_ImgeTxt').style.display = "none";//selVal_MCQImg_TXT
	document.getElementById('McQCnt_TF').style.display = "block";//selVal_MCQTF
	document.getElementById('McQCnt_TFImg').style.display = "none";//selVal_MCQ_TFImg
	}	
	if(x == 'selVal_MCQ_TFImg'){
	//alert('dfdsfdsf');
	document.getElementById('AddtnContent').style.display = "none";
	document.getElementById('SubtrnContent').style.display = "none";
	document.getElementById('MultpnContent').style.display = "none";
	document.getElementById('DvsnContent').style.display = "none";
    document.getElementById('FitbContent_text').style.display = "none";	
    document.getElementById('FitbContent_Img').style.display = "none";
	document.getElementById('MtFContent_text').style.display = "none";	
    document.getElementById('MtFContent_Img').style.display = "none"; 
	document.getElementById('McQContent_Txt').style.display = "none";//selVal_MCQText  
	document.getElementById('McQContent_Img').style.display = "none"; //selVal_MCQImg
	document.getElementById('McQCnt_ImgeTxt').style.display = "none";//selVal_MCQImg_TXT
	document.getElementById('McQCnt_TF').style.display = "none";//selVal_MCQTF
	document.getElementById('McQCnt_TFImg').style.display = "block";//selVal_MCQ_TFImg
	}			
}