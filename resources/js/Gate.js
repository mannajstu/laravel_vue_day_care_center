export default class Gate{

	constructor(user){
this.user=user;
}
isAdmin(){
	
		if(this.user==='admin'){
			return true;
		}
		
	}
	isParent(){
	
		if(this.user==='parent'){
			return true;
		}
		
	}
	isDoctor(){
	
		if(this.user==='doctor'){
			return true;
		}
		
	}
	isTeacher(){
	
		if(this.user==='teacher'){
			return true;
		}
		
	}
	
	




}