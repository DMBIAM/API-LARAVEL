import { Component, OnInit, ViewChild } from '@angular/core';
import { IonModal } from '@ionic/angular';
import { CategoriesService } from 'src/app/services/categories/categories.service';
import { CompaniesService } from 'src/app/services/companies/companies.service';
import { FavoritesService } from 'src/app/services/favorites/favorites.service';

@Component({
  selector: 'app-modal',
  templateUrl: './modal.component.html',
  styleUrls: ['./modal.component.scss'],
})
export class ModalComponent implements OnInit {
  @ViewChild(IonModal) modal!: IonModal;
  categories: any[] = [];
  companies: any[] = [];
  valueCompanyFilter: any = null;
  valueCategoryFilter: any = null;
  valueNameFilter: string = '';
  disableCompanyFilter: boolean = true;
  disableCategoryFilter: boolean = true;
  showLoading: boolean = false;
  favoritesList: any[] = [];

  constructor(
    private companiesService: CompaniesService,
    private categoriesService: CategoriesService,
    private favoritesService: FavoritesService
  ) { }

  ngOnInit() {
    this.getCategories();
    this.getCompanies();
  }

  canDismiss = true;
  presentingElement = document.querySelector('ion-app') || undefined;

  async getCategories() {
    this.categories = await this.categoriesService.list();
    this.disableCategoryFilter = false;
  }

  async getCompanies() {
    this.companies = await this.companiesService.list();
    this.disableCompanyFilter = false;
  }

  dismiss() {
    this.modal.dismiss();
  }

  async executeSearch() {
    const name = this.valueNameFilter;
    const company = this.valueCompanyFilter
    const category = this.valueCategoryFilter;
    this.showLoading = true;
    try {
      const data = await this.favoritesService.list(name, company, category);
      this.favoritesList = data;
      this.showLoading = false;
    } catch (error) {
      console.log(error);
    }
  }

  handleChangeCompany(e: any) {
    this.valueCompanyFilter = e.detail.value;
  }

  handleChangeCategory(e: any) {
    this.valueCategoryFilter = e.detail.value;
  }

  removeFavorite(favorite: any) {
    if (favorite.isDeleting) {
      return;
    }
    favorite.isDeleting = true;
    this.favoritesService.unregister(favorite.id)
      .then(() => {
        this.favoritesList = this.favoritesList.filter((item: any) => item.id !== favorite.id);
      }).catch(error => {
        alert('Error removing favorite');
        console.error('Error removing favorite:', error);
      }).finally(() => {
        favorite.isDeleting = false;
      });
  }

  resetFilter() {
    this.valueCompanyFilter = null;
    this.valueCategoryFilter = null;
    this.valueNameFilter = '';
    this.favoritesList = [];
  }

}
