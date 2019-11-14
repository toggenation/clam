let obj = {
    "meeting": {
        "schedule_id": 149,
        "co_visit": false
    },
    "success": false,
    "error": {
        "date": {
            "unique": "One of the meeting dates you submitted already exists!"
        }
    }
}


function flattenObject(ob) {
    var toReturn = {};

    for (var i in ob) {
        if (!ob.hasOwnProperty(i)) continue;

        if ((typeof ob[i]) === 'object' && ob[i] !== null) {
            var flatObject = flattenObject(ob[i]);
            for (var x in flatObject) {
                if (!flatObject.hasOwnProperty(x)) continue;

                toReturn[i + '.' + x] = flatObject[x];
            }
        } else {
            toReturn[i] = ob[i];
        }
    }
    return toReturn;
}
result = Object.values(flattenObject(obj.error));


console.log(result);
