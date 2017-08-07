$(document).ready(function(){
	url = $(location).attr("href");
	url = url.split("/");
	menu = $(".main-menu");
	switch(url[5])
	{
		case "user":
			menu.find(".user").addClass("opened");
			switch(url[6])
			{
				case "add_user":
					menu.find("li.user ul li:nth-child(1)").addClass("active");
				break;
				case "manage_user":
					menu.find("li.user ul li:nth-child(2)").addClass("active");
				break;
				case "inactive_user":
					menu.find("li.user ul li:nth-child(3)").addClass("active");
				break;
			}
		break;
		case "community":
			menu.find(".community").addClass("opened");
			switch(url[6])
			{
				case "add_community":
					menu.find("li.community ul li:nth-child(1)").addClass("active");
				break;
				case "manage_community":
					menu.find("li.community ul li:nth-child(2)").addClass("active");
				break;
				case "inactive_community":
					menu.find("li.community ul li:nth-child(3)").addClass("active");
				break;
			}
		break;
		case "classifieds":
			menu.find(".classifieds").addClass("opened");
			switch(url[6])
			{
				case "add_classifieds":
					menu.find("li.classifieds ul li:nth-child(1)").addClass("active");
				break;
				case "manage_classifieds":
					menu.find("li.classifieds ul li:nth-child(2)").addClass("active");
				break;
			}
		break;
		case "events":
			menu.find(".events").addClass("opened");
			switch(url[6])
			{
				case "add_events":
					menu.find("li.events ul li:nth-child(1)").addClass("active");
				break;
				case "manage_events":
					menu.find("li.events ul li:nth-child(2)").addClass("active");
				break;
			}
		break;
		case "form":
			menu.find(".form").addClass("opened");
			switch(url[6])
			{
				case "add_form":
					menu.find("li.form ul li:nth-child(1)").addClass("active");
				break;
				case "manage_form":
					menu.find("li.form ul li:nth-child(2)").addClass("active");
				break;
			}
		break;
		case "inbox":
			menu.find(".inbox").addClass("opened");
			switch(url[6])
			{
				case "compose":
					menu.find("li.inbox ul li:nth-child(1)").addClass("active");
				break;
				case "manage_inbox":
					menu.find("li.inbox ul li:nth-child(2)").addClass("active");
				break;
			}
		break;
		case "library":
			menu.find(".library").addClass("opened");
			switch(url[6])
			{
				case "manage_category":
					menu.find("li.library ul li:nth-child(1)").addClass("active");
				break;
				case "manage_documents":
					menu.find("li.library ul li:nth-child(2)").addClass("active");
				break;
				case "manage_files":
					menu.find("li.library ul li:nth-child(3)").addClass("active");
				break;
			}
		break;
	}

});