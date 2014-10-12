if (req.http.User-Agent ~ "JikeSpider|proximic|Sosospider|Baiduspider|Baiduspider+|BecomeBot|BecomeBot 3.0|BeslistBot|Bimbot|Sogou web spider|OpenVAS|msnbot-media|Bingbot|bingbot|bingbot/2.0|bingbot 2.0|AhrefsBot|Baiduspider/2.0|baiduspider|seznambot|Slurp|teoma|Yandex|Yeti|ia_archiver|DotBot/1.1") {
 error 403 "Forbidden";
}
