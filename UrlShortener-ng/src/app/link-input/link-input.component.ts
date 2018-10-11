import { Component, OnInit } from '@angular/core';
import { LinkInfo } from './link';
import { LinksService } from '../links.service';


@Component({
	selector: 'app-link-input',
	templateUrl: './link-input.component.html',
	styleUrls: ['./link-input.component.css']
})
export class LinkInputComponent implements OnInit {
		
	
	link: LinkInfo = {
		id:null,
		source: null,
		target:null
	};

	
	onSubmit(): void {
		var name = 'test';
  	  this.linksService.createUrl({ name } as Link)
        .subscribe(link => {
          this.heroes.push(link);
        });
	  
	
	}
	

    constructor(private linksService: LinksService) { }
	

	ngOnInit() {
	}
  

}
