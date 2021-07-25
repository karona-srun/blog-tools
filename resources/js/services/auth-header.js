export default function authHeader() {
    // let user = JSON.parse(localStorage.getItem("user"));
    let token = JSON.parse(localStorage.getItem("accessToken"));
    if (token) {
        let header = {
            "Access-Control-Allow-Origin": "*",
            "Content-Type": "application/x-www-form-urlencoded; application/json; charset=UTF-8",
            "Accept": "application/json",
            "Authorization": `Bearer ${token}`
        };
        return header;
    } else {
        return {};
    }
}
