sub vcl_recv {
	include "/usr/share/nginx/html/agents.vcl";

    if (req.http.host == "www.jfxrockwear.com.br") {
        set req.http.host = "jfxrockwear.com.br";
        error 750 "http://" + req.http.host + req.url;
    }

}

sub vcl_error {
    if (obj.status == 750) {
        set obj.http.Location = obj.response;
        set obj.status = 301;
        return(deliver);
    }
}
