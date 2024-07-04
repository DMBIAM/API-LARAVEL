import { Component, OnInit } from '@angular/core';
import { EmployeeService } from '../services/employee/employee.service';
import { FavoritesService } from '../services/favorites/favorites.service';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage implements OnInit {
  employees: any[] = [];
  sortedEmployees: any[] = [];
  currentPage: number = 1;
  lastPage: number = 1;
  showButton: boolean = false;
  showLoading: boolean = true;
  order: string = 'desc';
  showSegment: boolean = false;

  constructor(
    private employeeService: EmployeeService,
    private favoritesService: FavoritesService,
  ) { }

  async ngOnInit() {
    this.loadEmployees();
  }

  private async loadEmployees(page: number = 1) {
    try {
      const data = await this.employeeService.getEmployess(page);
      this.employees = [...this.employees, ...data.data];
      this.currentPage = data.current_page;
      this.lastPage = data.last_page;
      this.showButton = true;
      this.showLoading = false;
      this.showSegment = true;
      this.sortEmployees()
    } catch (error) {
      console.error('Error fetching cities', error);
      throw error;
    }
  }

  nextPage() {
    if (this.currentPage < this.lastPage) {
      this.loadEmployees(this.currentPage + 1);
      this.showLoading = true;
    }
  }

  previousPage() {
    if (this.currentPage > 1) {
      this.loadEmployees(this.currentPage - 1);
      this.showLoading = true;
    }
  }

  sortEmployees() {
    this.sortedEmployees = this.employeeService.sort(this.order, this.employees);
  }

  updateFavorite(employee: any, isChecked: boolean) {
    if (isChecked) {
      if (employee.favorites === null) {
        this.favoritesService.register(employee.id).then(newFavorite => {
          employee.favorites = newFavorite;
        });
      }
    } else {
      if (employee.favorites !== null) {
        this.favoritesService.unregister(employee.favorites.id).then(() => {
          employee.favorites = null;
        });
      }
    }
  }

}
