export abstract class AbstractLocalStorageService {

  protected localStorageKey: string;

  public set(value): void {
    localStorage.setItem(this.localStorageKey, value);
  }

  public get(): string {
    return localStorage.getItem((this.localStorageKey));
  }

  public remove(): void {
    localStorage.removeItem(this.localStorageKey);
  }
}
