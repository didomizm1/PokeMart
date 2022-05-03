class Reviews{
	constructor(options){
		let defaults = {
			page_id:1;,
			container:document.querySelector(".reviews"),
			php_file_url:"reviews.php"

		};
		this.options=Object.assign(defaults,options);
		this.fetchReviews();
	}
}

fetchReviews(){
	let url = `${this.phpFileUrl}?page_id=${this.page_Id}`;
	url += "current_pagination_page" in this.options ? `&current_pagination_page=${this.currentPaginationPage}` : '';
	url += "review_per_pagination_page" in this.options ? `&current_pagination_page=${this.reviewPerPagination}` : '';
	url += "sort_by" in this.options ? `&sort_by=${this.sortBy}` : ``;
	fetch(url).then(response => response.text()).then(data => {
		this.container.innerHTML = data;
		this._eventHandlers();
	});
}

get reviewsPerPagination(){
	return this.options.review_per_pagination_page;
}

set reviewsPerPaginationPage(value){
	this.options.review_per_pagination_page = value;
}

get currentPaginationPage(){
	return this.options.current_pagination_page;
}

set currentPaginationPage(value){
	this.options.current_pagination_page = value;
}

get page_Id(){
	return this.options.page_id;
}

set page_Id(value){
	this.options.page_id = value;
}

get phpFileUrl() {
	return this.options.php_file_url;
}

set phpFileUrl(value){
	this.options.php_file_url = value;
}

get container() {
	return this.options.container;
}

set container(value){
	this.options.container = value;
}

get sortBy() {
	return this.options.sort_by;
}

set sortBy(value) {
	this.options.sort_by = value;
}

_eventHandlers() {
	this.container.querySelector(".write_review_btn").onclick = event =>{
		event.preventDefault();
		this.container.querySelector(".write_review").style.display = 'block';
		this.container.querySelector(".write_review input[name='name]").focus();
	};
	this.container.querySelector(".write_review form").onsubmit = event =>{
		event.preventDefault();
		fetch(`${this.phpFileUrl}?page_id=${this.page_Id}`, {
			method: 'POST',
			body: new Formdata(this.container.querySelector(".write_review form"))
		}).then(response => response.text()).then(data => {
			this.container.querySelector(".write_review").innerHTML = data;
		});
	};
	this.container.querySelector(".sort_by").onchange = event => {
		this.sortBy = event.target.value;
		this.fetchReviews();
	};
	if(this.reviewsPerPaginationPage && this.currentPaginationPage){
		this.container.querySelectorAll(".pagination a").forEach(a => {
			a.onclick = event => {
				event.preventDefault();
				this.currentPaginationPage = event.target.dataset.pagination_page;
				this.reviewsPerPaginationPage = event.target.dataset.records_per_page;
				this.fetchReviews();
			};
		});
	}

	
}
