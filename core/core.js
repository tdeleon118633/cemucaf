function getDocumentLayer(strName, objDoc) {
	var p,i,x=false;

	if(!objDoc) objDoc=document;

	if(objDoc[strName]) {
		x=objDoc[strName];
		if (!x.tagName) x = false;
	}

	if (!x && objDoc.all) x=objDoc.all[strName];
	for (i=0;!x && i<objDoc.forms.length; i++) x=objDoc.forms[i][strName];
	if (!x && objDoc.getElementById) x=objDoc.getElementById(strName);
	for (i=0;!x && objDoc.layers && i<objDoc.layers.length; i++) x=getDocumentLayer(strName,objDoc.layers[i].document);
	//for(i=0;!x && i<objDoc.all.length; i++) if (objDoc.all(i).id == strName || objDoc.all(i).name == strName) x = objDoc.all(i);

	return x;
}