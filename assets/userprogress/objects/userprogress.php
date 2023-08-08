<?php

// Object corresponding to game_play_tbl

class userprogress {
	
	private $PMST; 
	private $CMST; 

	private $PMNST; 
	private $CMNSST; 

	private $PMGMT; 
	private $CMMST;

	private $PALGT; 
	private $CMNOST;  

	private $PNS;              
	private $PALG;        
	private $PGM;           
	// private $PSG;          
	// private $PDH; 

	private $PNSN;    
	private $PNSI; 
	private $PNSF;       
	private $PNSD;      
	private $PNSR;  
	private $PALGV;  
	private $PGMS;  
	private $PGMM;  

	private $PMV;  
	private $PNOA;  
	private $PNOS;  
	private $PNOM;  
	private $PNOD;  
	private $PNOLD;  
	private $PNOLM;  

	private $CNS;              
	private $CNO;        
	private $CM;           
	private $CNSN;    
	private $CNSF; 
	private $CNSS;       
	private $CNSC;      
	private $CNSPV;  
	private $CML;  
	private $CMW;  
	private $CMTi;  
	private $CMV;  
	private $CNOA;  
	private $CNOS;  
	private $CNOM;  
	private $CNOD;

	private $CNSP;              
	private $CNOP;        
	private $CMP;           
	private $CNSNP;    
	private $CNSFP; 
	private $CNSSP;       
	private $CNSCP;      
	private $CNSPVP;  
	private $CMLP;  
	private $CMWP;  
	private $CMTP;  
	private $CMVP;  
	private $CNOAP;  
	private $CNOSP;  
	private $CNOMP;  
	private $CNODP;  

	private $CNSFF;              
        private $CNOF;        
        private $CMF;           
        private $CNSNF;    
        private $CNSFFF; 
        private $CNSSF;       
        private $CNSCF;      
        private $CNSPVF;  
        private $CMLF;  
        private $CMWF;  
        private $CMTF;  
        private $CMVF;  
        private $CNOAF;  
        private $CNOSF;  
        private $CNOMF;  
        private $CNODF;

	private $CNST;              
	private $CNOT;        
	private $CMT;           
	private $CNSNT;    
	private $CNSFT; 
	private $CNSST;       
	private $CNSCT;      
	private $CNSPVT;  
	private $CMLT;  
	private $CMWT;  
	private $CMTT;  
	private $CMVT;  
	private $CNOAT;  
	private $CNOST;  
	private $CNOMT;  
	private $CNODT;  

	private $CNSH;              
	private $CNOH;        
	private $CMH;           
	private $CNSNH;    
	private $CNSFH; 
	private $CNSSH;       
	private $CNSCH;      
	private $CNSPVH;  
	private $CMLH;  
	private $CMWH;  
	private $CMTH;  
	private $CMVH;  
	private $CNOAH;  
	private $CNOSH;  
	private $CNOMH;  
	private $CNODH;  

	function setPMST($PMST){
	    $this->PMST = $PMST;
	}
	
	function getPMST(){
	    return $this->PMST;
	}
	
	function setCMST($CMST){
	    $this->CMST = $CMST;
	}
	
	function getCMST(){
	    return $this->CMST;
	}


	function setPMNST($PMNST){
	    $this->PMNST = $PMNST;
	}
	
	function getPMNST(){
	    return $this->PMNST;
	}
	
	function setCMNSST($CMNSST){
	    $this->CMNSST = $CMNSST;
	}
	
	function getCMNSST(){
	    return $this->CMNSST;
	}


	function setPMGMT($PMGMT){
	    $this->PMGMT = $PMGMT;
	}
	
	function getPMGMT(){
	    return $this->PMGMT;
	}
	
	function setCMMST($CMMST){
	    $this->CMMST = $CMMST;
	}
	
	function getCMMST(){
	    return $this->CMMST;
	}


	function setPALGT($PALGT){
	    $this->PALGT = $PALGT;
	}
	
	function getPALGT(){
	    return $this->PALGT;
	}
	
	function setCMNOST($CMNOST){
	    $this->CMNOST = $CMNOST;
	}
	
	function getCMNOST(){
	    return $this->CMNOST;
	}



	function setPNS($PNS){
	    $this->PNS = $PNS;
	}
	
	function getPNS(){
	    return $this->PNS;
	}
//	
	function setPALG($PALG){
	    $this->PALG = $PALG;
	}
	
	function getPALG(){
	    return $this->PALG;
	}
//	
	function setPGM($PGM){
	    $this->PGM = $PGM;
	}
	
	function getPGM(){
	    return $this->PGM;
	}
//	
	function setPNSN($PNSN){
	    $this->PNSN = $PNSN;
	}
	
	function getPNSN(){
	    return $this->PNSN;
	}
//
	function setPNSI($PNSI){
	    $this->PNSI = $PNSI;
	}

	function getPNSI(){
	    return $this->PNSI;
	}
//	
	function setPNSF($PNSF){
	    $this->PNSF = $PNSF;
	}
	
	function getPNSF(){
	    return $this->PNSF;
	}
//	
	function setPNSD($PNSD){
	    $this->PNSD = $PNSD;
	}
	
	function getPNSD(){
	    return $this->PNSD;
	}
//	
	function setPNSR($PNSR){
	    $this->PNSR = $PNSR;
	}
	
	function getPNSR(){
	    return $this->PNSR;
	}
//	
	function setPALGV($PALGV){
	    $this->PALGV = $PALGV;
	}
	
	function getPALGV(){
	    return $this->PALGV;
	}
//	
	function setPGMS($PGMS){
	    $this->PGMS = $PGMS;
	}
	
	function getPGMS(){
	    return $this->PGMS;
	}
//
	function setPGMM($PGMM){
	    $this->PGMM = $PGMM;
	}
	
	function getPGMM(){
	    return $this->PGMM;
	}
//	
	function setPMW($PMW){
	    $this->PMW = $PMW;
	}
	
	function getPMW(){
	    return $this->PMW;
	}
	function setPMT($PMT){
	    $this->PMT = $PMT;
	}
	
	function getPMT(){
	    return $this->PMT;
	}
	function setPMV($PMV){
	    $this->PMV = $PMV;
	}
	
	function getPMV(){
	    return $this->PMV;
	}
	function setPNOA($PNOA){
	    $this->PNOA = $PNOA;
	}
	
	function getPNOA(){
	    return $this->PNOA;
	}
	function setPNOS($PNOS){
	    $this->PNOS = $PNOS;
	}
	
	function getPNOS(){
	    return $this->PNOS;
	}
	function setPNOM($PNOM){
	    $this->PNOM = $PNOM;
	}
	
	function getPNOM(){
	    return $this->PNOM;
	}
	function setPNOD($PNOD){
	    $this->PNOD = $PNOD;
	}
	
	function getPNOD(){
	    return $this->PNOD;
	}

	function setPNOLD($PNOLD){
	    $this->PNOLD = $PNOLD;
	}
	
	function getPNOLD(){
	    return $this->PNOLD;
	}

	function setPNOLM($PNOLM){
	    $this->PNOLM = $PNOLM;
	}
	
	function getPNOLM(){
	    return $this->PNOLM;
	}

	function setCNS($CNS){
	    $this->CNS = $CNS;
	}
	
	function getCNS(){
	    return $this->CNS;
	}
	
	function setCNO($CNO){
	    $this->CNO = $CNO;
	}
	
	function getCNO(){
	    return $this->CNO;
	}
	
	function setCM($CM){
	    $this->CM = $CM;
	}
	
	function getCM(){
	    return $this->CM;
	}
	
	
	function setCNSN($CNSN){
	    $this->CNSN = $CNSN;
	}
	
	function getCNSN(){
	    return $this->CNSN;
	}
	
	function setCNSF($CNSF){
	    $this->CNSF = $CNSF;
	}
	
	function getCNSF(){
	    return $this->CNSF;
	}
	
	function setCNSS($CNSS){
	    $this->CNSS = $CNSS;
	}
	
	function getCNSS(){
	    return $this->CNSS;
	}
	
	function setCNSC($CNSC){
	    $this->CNSC = $CNSC;
	}
	
	function getCNSC(){
	    return $this->CNSC;
	}
	
	function setCNSPV($CNSPV){
	    $this->CNSPV = $CNSPV;
	}
	
	function getCNSPV(){
	    return $this->CNSPV;
	}
	function setCML($CML){
	    $this->CML = $CML;
	}
	
	function getCML(){
	    return $this->CML;
	}
	function setCMW($CMW){
	    $this->CMW = $CMW;
	}
	
	function getCMW(){
	    return $this->CMW;
	}
	function setCMTT($CMTT){
	    $this->CMTT = $CMTT;
	}
	
	function getCMTT(){
	    return $this->CMTT;
	}
	function setCMV($CMV){
	    $this->CMV = $CMV;
	}
	
	function getCMV(){
	    return $this->CMV;
	}
	function setCNOA($CNOA){
	    $this->CNOA = $CNOA;
	}
	
	function getCNOA(){
	    return $this->CNOA;
	}
	function setCNOS($CNOS){
	    $this->CNOS = $CNOS;
	}
	
	function getCNOS(){
	    return $this->CNOS;
	}
	function setCNOM($CNOM){
	    $this->CNOM = $CNOM;
	}
	
	function getCNOM(){
	    return $this->CNOM;
	}
	function setCNOD($CNOD){
	    $this->CNOD = $CNOD;
	}
	
	function getCNOD(){
	    return $this->CNOD;
	}

	function setCNST($CNST){
	    $this->CNST = $CNST;
	}
	
	function getCNST(){
	    return $this->CNST;
	}
	
	function setCNOT($CNOT){
	    $this->CNOT = $CNOT;
	}
	
	function getCNOT(){
	    return $this->CNOT;
	}
	
	function setCMT($CMT){
	    $this->CMT = $CMT;
	}
	
	function getCMT(){
	    return $this->CMT;
	}

	function setCMTi($CMTi){
	    $this->CMTi = $CMTi;
	}
	
	function getCMTi(){
	    return $this->CMTi;
	}
	
	
	function setCNSNT($CNSNT){
	    $this->CNSNT = $CNSNT;
	}
	
	function getCNSNT(){
	    return $this->CNSNT;
	}
	
	function setCNSFT($CNSFT){
	    $this->CNSFT = $CNSFT;
	}
	
	function getCNSFT(){
	    return $this->CNSFT;
	}
	
	function setCNSST($CNSST){
	    $this->CNSST = $CNSST;
	}
	
	function getCNSST(){
	    return $this->CNSCT;
	}
	
	function setCNSCT($CNSCT){
	    $this->CNSCT = $CNSCT;
	}
	
	function getCNSCT(){
	    return $this->CNSCT;
	}
	
	function setCNSPVT($CNSPVT){
	    $this->CNSPVT = $CNSPVT;
	}
	
	function getCNSPVT(){
	    return $this->CNSPVT;
	}
	function setCMLT($CMLT){
	    $this->CMLT = $CMLT;
	}
	
	function getCMLT(){
	    return $this->CMLT;
	}
	function setCMWT($CMWT){
	    $this->CMWT = $CMWT;
	}
	
	function getCMWT(){
	    return $this->CMWT;
	}
	/*function setCMTT($CMTT){
	    $this->CMTT = $CMTT;
	}
	
	function getCMTT(){
	    return $this->CMTT;
	}*/
	function setCMVT($CMVT){
	    $this->CMVT = $CMVT;
	}
	
	function getCMVT(){
	    return $this->CMVT;
	}
	function setCNOAT($CNOAT){
	    $this->CNOAT = $CNOAT;
	}
	
	function getCNOAT(){
	    return $this->CNOAT;
	}
	function setCNOST($CNOST){
	    $this->CNOST = $CNOST;
	}
	
	function getCNOST(){
	    return $this->CNOST;
	}
	function setCNOMT($CNOMT){
	    $this->CNOMT = $CNOMT;
	}
	
	function getCNOMT(){
	    return $this->CNOMT;
	}
	function setCNODT($CNODT){
	    $this->CNODT = $CNODT;
	}
	
	function getCNODT(){
	    return $this->CNODT;
	}


	function setCNSP($CNSP){
	    $this->CNSP = $CNSP;
	}
	
	function getCNSP(){
	    return $this->CNSP;
	}
	
	function setCNOP($CNOP){
	    $this->CNOP = $CNOP;
	}
	
	function getCNOP(){
	    return $this->CNOP;
	}
	
	function setCMP($CMP){
	    $this->CMP = $CMP;
	}
	
	function getCMP(){
	    return $this->CMP;
	}
	
	
	function setCNSNP($CNSNP){
	    $this->CNSNP = $CNSNP;
	}
	
	function getCNSNP(){
	    return $this->CNSNP;
	}
	
	function setCNSFP($CNSFP){
	    $this->CNSFP = $CNSFP;
	}
	
	function getCNSFP(){
	    return $this->CNSFP;
	}
	
	function setCNSSP($CNSSP){
	    $this->CNSSP = $CNSSP;
	}
	
	function getCNSSP(){
	    return $this->CNSCP;
	}
	
	function setCNSCP($CNSCP){
	    $this->CNSCP = $CNSCP;
	}
	
	function getCNSCP(){
	    return $this->CNSCP;
	}
	
	function setCNSPVP($CNSPVP){
	    $this->CNSPVP = $CNSPVP;
	}
	
	function getCNSPVP(){
	    return $this->CNSPVP;
	}
	function setCMLP($CMLP){
	    $this->CMLP = $CMLP;
	}
	
	function getCMLP(){
	    return $this->CMLP;
	}
	function setCMWP($CMWP){
	    $this->CMWP = $CMWP;
	}
	
	function getCMWP(){
	    return $this->CMWP;
	}
	function setCMTP($CMTTP){
	    $this->CMTTP = $CMTTP;
	}
	
	function getCMTP(){
	    return $this->CMTTP;
	}
	function setCMTTP($CMTTP){
	    $this->CMTTP = $CMTTP;
	}
	
	function getCMTTP(){
	    return $this->CMTTP;
	}
	function setCMVP($CMVP){
	    $this->CMVP = $CMVP;
	}
	
	function getCMVP(){
	    return $this->CMVP;
	}
	function setCNOAP($CNOAP){
	    $this->CNOAP = $CNOAP;
	}
	
	function getCNOAP(){
	    return $this->CNOAP;
	}
	function setCNOSP($CNOSP){
	    $this->CNOSP = $CNOSP;
	}
	
	function getCNOSP(){
	    return $this->CNOSP;
	}
	function setCNOMP($CNOMP){
	    $this->CNOMP = $CNOMP;
	}
	
	function getCNOMP(){
	    return $this->CNOMP;
	}
	function setCNODP($CNODP){
	    $this->CNODP = $CNODP;
	}
	
	function getCNODP(){
	    return $this->CNODP;
	}

	function setCNSFF($CNSFF){
            $this->CNSFF = $CNSFF;
        }
        
        function getCNSFF(){
            return $this->CNSFF;
        }
        
        function setCNOF($CNOF){
            $this->CNOF = $CNOF;
        }
        
        function getCNOF(){
            return $this->CNOF;
        }
        
        function setCMF($CMF){
            $this->CMF = $CMF;
        }
        
        function getCMF(){
            return $this->CMF;
        }
        
        
        function setCNSNF($CNSNF){
            $this->CNSNF = $CNSNF;
        }
        
        function getCNSNF(){
            return $this->CNSNF;
        }
        
        function setCNSFFF($CNSFFF){
            $this->CNSFFF = $CNSFFF;
        }
        
        function getCNSFFF(){
            return $this->CNSFFF;
        }
        
        function setCNSSF($CNSSF){
            $this->CNSSF = $CNSSF;
        }
        
        function getCNSSF(){
            return $this->CNSCF;
        }
        
        function setCNSCF($CNSCF){
            $this->CNSCF = $CNSCF;
        }
        
        function getCNSCF(){
            return $this->CNSCF;
        }
        
        function setCNSPVF($CNSPVF){
            $this->CNSPVF = $CNSPVF;
        }
        
        function getCNSPVF(){
            return $this->CNSPVF;
        }
        function setCMLF($CMLF){
            $this->CMLF = $CMLF;
        }
        
        function getCMLF(){
            return $this->CMLF;
        }
        function setCMWF($CMWF){
            $this->CMWF = $CMWF;
        }
        
        function getCMWF(){
            return $this->CMWF;
        }
        function setCMTF($CMTTF){
            $this->CMTTF = $CMTTF;
        }
        
        function getCMTF(){
            return $this->CMTTF;
        }
        function setCMTTF($CMTTF){
            $this->CMTTF = $CMTTF;
        }
        
        function getCMTTF(){
            return $this->CMTTF;
        }
        function setCMVF($CMVF){
            $this->CMVF = $CMVF;
        }
        
        function getCMVF(){
            return $this->CMVF;
        }
        function setCNOAF($CNOAF){
            $this->CNOAF = $CNOAF;
        }
        
        function getCNOAF(){
            return $this->CNOAF;
        }
        function setCNOSF($CNOSF){
            $this->CNOSF = $CNOSF;
        }
        
        function getCNOSF(){
            return $this->CNOSF;
        }
        function setCNOMF($CNOMF){
            $this->CNOMF = $CNOMF;
        }
        
        function getCNOMF(){
            return $this->CNOMF;
        }
        function setCNODF($CNODF){
            $this->CNODF = $CNODF;
        }
        
        function getCNODF(){
            return $this->CNODF;
        }

	function setCNSH($CNSH){
	    $this->CNSH = $CNSH;
	}
	
	function getCNSH(){
	    return $this->CNSH;
	}
	
	function setCNOH($CNOH){
	    $this->CNOH = $CNOH;
	}
	
	function getCNOH(){
	    return $this->CNOH;
	}
	
	function setCMH($CMH){
	    $this->CMH = $CMH;
	}
	
	function getCMH(){
	    return $this->CMH;
	}
	
	
	function setCNSNH($CNSNH){
	    $this->CNSNH = $CNSNH;
	}
	
	function getCNSNH(){
	    return $this->CNSNH;
	}
	
	function setCNSFH($CNSFH){
	    $this->CNSFH = $CNSFH;
	}
	
	function getCNSFH(){
	    return $this->CNSFH;
	}
	
	function setCNSSH($CNSSH){
	    $this->CNSSH = $CNSSH;
	}
	
	function getCNSSH(){
	    return $this->CNSCH;
	}
	
	function setCNSCH($CNSCH){
	    $this->CNSCH = $CNSCH;
	}
	
	function getCNSCH(){
	    return $this->CNSCH;
	}
	
	function setCNSPVH($CNSPVH){
	    $this->CNSPVH = $CNSPVH;
	}
	
	function getCNSPVH(){
	    return $this->CNSPVH;
	}
	function setCMLH($CMLH){
	    $this->CMLH = $CMLH;
	}
	
	function getCMLH(){
	    return $this->CMLH;
	}
	function setCMWH($CMWH){
	    $this->CMWH = $CMWH;
	}
	
	function getCMWH(){
	    return $this->CMWH;
	}
	function setCMTH($CMTH){
	    $this->CMTH = $CMTH;
	}
	
	function getCMTH(){
	    return $this->CMTH;
	}
	function setCMVH($CMVH){
	    $this->CMVH = $CMVH;
	}
	
	function getCMVH(){
	    return $this->CMVH;
	}
	function setCNOAH($CNOAH){
	    $this->CNOAH = $CNOAH;
	}
	
	function getCNOAH(){
	    return $this->CNOAH;
	}
	function setCNOSH($CNOSH){
	    $this->CNOSH = $CNOSH;
	}
	
	function getCNOSH(){
	    return $this->CNOSH;
	}
	function setCNOMH($CNOMH){
	    $this->CNOMH = $CNOMH;
	}
	
	function getCNOMH(){
	    return $this->CNOMH;
	}
	function setCNODH($CNODH){
	    $this->CNODH = $CNODH;
	}
	
	function getCNODH(){
	    return $this->CNODH;
	}
	
	
}

?>