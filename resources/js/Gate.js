export default class Gate{

	constructor(user){
this.user=user;
}

isAdmin(){
	for (var i = 0; i < this.user.length; i++) {
		if(this.user[i].name==='admin'){
			return true;
		}
		
	}
	

}
isAdminParent(){
	for (var i = 0; i < this.user.length; i++) {
		if(this.user[i].name==='admin'||this.user[i].name==='parent'){
			return true;
		}
		
	}
	

}
isAdminDoctor(){
	for (var i = 0; i < this.user.length; i++) {
		if(this.user[i].name==='admin'||this.user[i].name==='doctor'){
			return true;
		}
		
	}
	

}
isAdminTeacher(){
	for (var i = 0; i < this.user.length; i++) {
		if(this.user[i].name==='admin'||this.user[i].name==='teacher'){
			return true;
		}
		
	}
	

}


}