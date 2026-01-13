<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$this->call(UsersTableSeeder::class);
		$this->call(ObjectNamesTableSeeder::class);
		$this->call(TypeTableSeeder::class );
		$this->call(CityTableSeeder::class);		
		$this->call(FeatureTableSeeder::class );
		$this->call(ProfileTableSeeder::class);
		$this->call(AdsTableSeeder::class);
		$this->call(VelayatTableSeeder::class);
		$this->call(siteSettingsTableSeeder::class);
		$this->call(PropertyDescriptionSeeder::class);		
		$this->call(RevampTableSeeder::class);
		$this->call(complaintTableSeeder::class);
		$this->call(complaintDetailTableSeeder::class);
		$this->call(BuildingTableSeeder::class);
		$this->call(accountTypeTableSeeder::class);
		$this->call(dealTypeTableSeeder::class);
		$this->call(typeRentTableSeeder::class);
		$this->call(typeEstateTableSeeder::class);
		$this->call(typePropertyListTableSeeder::class);
		$this->call(OfficeRepairSeeder::class);
		$this->call(BuildingTypeSeeder::class);
		$this->call(VentilationTableSeeder::class);
        $this->call(ConditioningTableSeeder::class);
        $this->call(HeatingTableSeeder::class);
        $this->call(FirefightingTableSeeder::class);
        $this->call(InfrastructureTableSeeder::class);
        $this->call(BathroomSeeder::class);
        $this->call(RentTermSeeder::class);
        $this->call(ParkingSeeder::class);
        $this->call(LandAreaTypeSeeder::class);
        $this->call(EntranceSeeder::class);
        $this->call(OfficeConditionSeeder::class);
        $this->call(LandOwningTypeSeeder::class);
        $this->call(BuildingEntranceSeeder::class);
        $this->call(TradeRoomsSeeder::class);
        $this->call(GatesSeeder::class);
        $this->call(FloorMaterialSeeder::class);
        $this->call(RentTypeSeeder::class);
        $this->call(BusinessTypePropertySeeder::class);
        $this->call(BusinessTypeSeeder::class);
        $this->call(LandStatusSeeder::class);
        $this->call(PeriodSeeder::class);
        $this->call(ParkingTypeSeeder::class);
        $this->call(SaleTypeSeeder::class);
        $this->call(BonusAgentSeeder::class);
        $this->call(TaxSeeder::class);
        $this->call(PossibleAppointmentSeeder::class);
        $this->call(DayWeekSeeder::class);
        $this->call(DocumentsTableSeeder::class);
        $this->call(AddserviceSeeder::class);
		$this->call(PriceUnitSeeder::class);
		$this->call(ApartmentTypeSeeder::class);
		$this->call(RoomLayoutSeeder::class);
		$this->call(propertyDealTypeTableSeeder::class);
		$this->call(propertyObjectTypeTableSeeder::class);
	}
}
