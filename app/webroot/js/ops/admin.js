/**
 * for extracting json response
 **/
function ensureJSON(response) {
	var lastPosition = response.lastIndexOf("}");
	return response.substr(0, lastPosition + 1);
}
