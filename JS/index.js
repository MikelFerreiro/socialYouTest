var DB = [];

schema = ["id", "name", "age"]
function model(operation, data, schema){
	switch(operation){
		case "add":
			let DBList = {}
			for (const [key, value] of Object.entries(data)){
				if (schema.includes(key))
					DBList[key]=value;
			}
			console.log(JSON.stringify(DBList));
			break;
		default:
			break;
	}
}
model("add", {id: 1, name: "Joe", age: 32, address: "Muntaner 262, Barcelona"}, schema);