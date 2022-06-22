import { MarkerClusterer } from '@googlemaps/markerclusterer';
class FindRetailer {
	constructor(sector) {
		function LocatorPlus(configuration) {
			const locator = this;
			locator.locations = configuration.locations || [];
			locator.capabilities = configuration.capabilities || {};
			const mapEl = sector.querySelector('#map');
			locator.panelListEl = sector.querySelector('#locations-panel-list');
			const sectionNameEl = sector.querySelector(
				'#location-results-section-name'
			);
			const resultsContainerEl = sector.querySelector(
				'#location-results-list'
			);
			// eslint-disable-next-line no-undef
			const itemsTemplate = Handlebars.compile(
				document.getElementById('locator-result-items-tmpl').innerHTML
			);

			locator.searchLocation = null;
			locator.searchLocationMarker = null;
			locator.selectedLocationIdx = null;
			locator.userCountry = null;

			// Initialize the map -------------------------------------------------------
			locator.map = new google.maps.Map(mapEl, configuration.mapOptions);

			// Store selection.
			const selectResultItem = function (
				locationIdx,
				panToMarker,
				scrollToResult
			) {
				locator.panelListEl.classList.add(
					'retailer-locations__inner--active'
				);

				locator.selectedLocationIdx = locationIdx;
				for (const locationElem of resultsContainerEl.children) {
					locationElem.classList.remove('retailer-card--selected');
					if (
						getResultIndex(locationElem) ===
						locator.selectedLocationIdx
					) {
						locationElem.classList.add('retailer-card--selected');
						if (scrollToResult) {
							const offset = 117;
							const bodyRect =
								document.body.getBoundingClientRect().top;
							const elementRect =
								locationElem.getBoundingClientRect().top;
							const elementPosition = elementRect - bodyRect;
							const offsetPosition = elementPosition - offset;

							window.scrollTo({
								top: offsetPosition,
								behavior: 'instant',
								block: 'center',
							});
						}
					}
				}
				if (panToMarker && locationIdx !== null) {
					locator.map.panTo(locator.locations[locationIdx].coords);
					locator.map.setZoom(11);
				}
			};

			const svgMarker = {
				path: 'M15.999 0c-6.123 0-11.105 4.982-11.105 11.105 0 5.894 10.075 19.665 10.504 20.248l0.4 0.545c0.047 0.064 0.121 0.101 0.2 0.101 0.080 0 0.154-0.037 0.201-0.102l0.4-0.545c0.429-0.583 10.504-14.354 10.504-20.248 0-6.123-4.982-11.105-11.105-11.105zM15.999 7.127c2.194 0 3.978 1.784 3.978 3.978 0 2.193-1.784 3.978-3.978 3.978-2.193 0-3.978-1.785-3.978-3.978 0-2.194 1.785-3.978 3.978-3.978z',
				fillColor: 'black',
				fillOpacity: 0.6,
				strokeWeight: 0,
				rotation: 0,
				scale: 1,
				anchor: new google.maps.Point(15, 30),
			};

			// Create a marker for each location.
			const markers = locator.locations.map(function (location, index) {
				const marker = new google.maps.Marker({
					position: location.coords,
					map: locator.map,
					icon: svgMarker,
					title: location.title,
				});
				marker.addListener('click', function () {
					selectResultItem(index, true, true);
				});
				return marker;
			});
			const markerCluster = new MarkerClusterer({
				map: locator.map,
				markers,
			});
			// Fit map to marker bounds.
			locator.updateBounds = function () {
				const bounds = new google.maps.LatLngBounds();
				if (locator.searchLocationMarker) {
					bounds.extend(locator.searchLocationMarker.getPosition());
				}
				for (let i = 0; i < markers.length; i++) {
					bounds.extend(markers[i].getPosition());
				}
				locator.map.fitBounds(bounds);
			};
			if (locator.locations.length) {
				locator.updateBounds();
			}

			// Get the distance of a store location to the user's location,
			// used in sorting the list.
			const getLocationDistance = function (location) {
				if (!locator.searchLocation) return null;

				// Use travel distance if available (from Distance Matrix).
				if (location.travelDistanceValue != null) {
					return location.travelDistanceValue;
				}

				// Fall back to straight-line distance.
				return google.maps.geometry.spherical.computeDistanceBetween(
					new google.maps.LatLng(location.coords),
					locator.searchLocation.location
				);
			};

			// Render the results list --------------------------------------------------
			const getResultIndex = function (elem) {
				return parseInt(elem.getAttribute('data-location-index'));
			};

			locator.renderResultsList = function () {
				const locations = locator.locations.slice();
				for (let i = 0; i < locations.length; i++) {
					locations[i].index = i;
				}
				if (locator.searchLocation) {
					sectionNameEl.textContent = 'Nearest 25 locations';
					locations.sort(function (a, b) {
						return getLocationDistance(a) - getLocationDistance(b);
					});
				} else {
					sectionNameEl.textContent = `All locations (${locations.length})`;
				}
				const resultItemContext = { locations };
				resultsContainerEl.innerHTML = itemsTemplate(resultItemContext);
				for (const item of resultsContainerEl.children) {
					const resultIndex = getResultIndex(item);
					if (resultIndex === locator.selectedLocationIdx) {
						item.classList.add('selected');
					}

					const resultSelectionHandler = function () {
						selectResultItem(resultIndex, true, false);
					};

					// Clicking anywhere on the item selects this location.
					// Additionally, create a button element to make this behavior
					// accessible under tab navigation.
					item.addEventListener('click', resultSelectionHandler);
					item.querySelector('.select-location').addEventListener(
						'click',
						function (e) {
							resultSelectionHandler();
							e.stopPropagation();
						}
					);
				}
			};
			// Optional capability initialization --------------------------------------
			initializeSearchInput(locator);
			// initializeDistanceMatrix(locator);
			// Initial render of results -----------------------------------------------
			locator.renderResultsList();
		}
		/**
		 * When the search input capability is enabled, initialize it.
		 *
		 * @param  locator
		 */
		function initializeSearchInput(locator) {
			const geocodeCache = new Map();
			const geocoder = new google.maps.Geocoder();

			const searchInputEl = document.getElementById(
				'location-search-input'
			);
			const searchButtonEl = document.getElementById(
				'location-search-button'
			);

			const updateSearchLocation = function (address, location) {
				if (locator.searchLocationMarker) {
					locator.searchLocationMarker.setMap(null);
				}
				if (!location) {
					locator.searchLocation = null;
					return;
				}

				locator.searchLocation = {
					address,
					location,
				};

				locator.searchLocationMarker = new google.maps.Marker({
					position: location,
					map: locator.map,
					title: 'My location',
					icon: {
						path: google.maps.SymbolPath.CIRCLE,
						scale: 15,
						fillColor: '#a53746',
						fillOpacity: 0.8,
						strokeOpacity: 0,
					},
				});

				locator.panelListEl.classList.add(
					'retailer-locations__inner--active'
				);

				// Update the locator's idea of the user's country, used for units. Use
				// `formatted_address` instead of the more structured `address_components`
				// to avoid an additional billed call.
				const addressParts = address.split(' ');
				locator.userCountry = addressParts[addressParts.length - 1];

				// Update map bounds to include the new location marker.
				locator.updateBounds();

				// Update the result list, so we can sort it by proximity.
				locator.renderResultsList();

				// locator.updateTravelTimes();

				setTimeout(function () {
					loadiingAnimation();
					locator.map.panTo(location);
					locator.map.setZoom(11);
				}, 0);
			};

			const geocodeSearch = function (query) {
				if (!query) {
					return;
				}

				const handleResult = function (geocodeResult) {
					searchInputEl.value = geocodeResult.formatted_address;
					updateSearchLocation(
						geocodeResult.formatted_address,
						geocodeResult.geometry.location
					);
				};

				if (geocodeCache.has(query)) {
					handleResult(geocodeCache.get(query));
					return;
				}
				const request = {
					address: query,
					bounds: locator.map.getBounds(),
				};
				geocoder.geocode(request, function (results, status) {
					if (status === 'OK') {
						if (results.length > 0) {
							const result = results[0];
							geocodeCache.set(query, result);
							handleResult(result);
						}
					}
				});
			};

			// Set up geocoding on the search input.
			searchButtonEl.addEventListener('click', function () {
				geocodeSearch(searchInputEl.value.trim());
			});

			// Initialize Autocomplete.
			initializeSearchInputAutocomplete(
				locator,
				searchInputEl,
				geocodeSearch,
				updateSearchLocation
			);
		}

		/**
		 * Add Autocomplete to the search input.
		 *
		 * @param  locator
		 * @param  searchInputEl
		 * @param  fallbackSearch
		 * @param  searchLocationUpdater
		 */
		function initializeSearchInputAutocomplete(
			locator,
			searchInputEl,
			fallbackSearch,
			searchLocationUpdater
		) {
			// Set up Autocomplete on the search input. Bias results to map viewport.
			const autocomplete = new google.maps.places.Autocomplete(
				searchInputEl,
				{
					types: ['geocode'],
					fields: [
						'place_id',
						'formatted_address',
						'geometry.location',
					],
				}
			);
			autocomplete.bindTo('bounds', locator.map);
			autocomplete.addListener('place_changed', function () {
				loadiingAnimation();

				setTimeout(function () {
					const placeResult = autocomplete.getPlace();
					if (!placeResult.geometry) {
						// Hitting 'Enter' without selecting a suggestion will result in a
						// placeResult with only the text input value as the 'name' field.
						fallbackSearch(placeResult.name);
						return;
					}
					searchLocationUpdater(
						placeResult.formatted_address,
						placeResult.geometry.location
					);
				}, 100);
			});
		}
		/**
		 * Initialize Distance Matrix for the locator.
		 *
		 * @param  locator
		 */
		function initializeDistanceMatrix(locator) {
			const distanceMatrixService =
				new google.maps.DistanceMatrixService();

			// Annotate travel times to the selected location using Distance Matrix.
			locator.updateTravelTimes = function () {
				if (!locator.searchLocation) return;
				const request = {
					origins: [locator.searchLocation.location],
					destinations: locator.locations.map(function (x) {
						return x.coords;
					}),
					travelMode: google.maps.TravelMode.DRIVING,
					unitSystem: google.maps.UnitSystem.IMPERIAL,
				};

				const callback = function (response, status) {
					if (status === 'OK') {
						const distances = response.rows[0].elements;
						for (let i = 0; i < distances.length; i++) {
							const distResult = distances[i];
							let travelDistanceText, travelDistanceValue;
							if (distResult.status === 'OK') {
								travelDistanceText = distResult.distance.text;
								travelDistanceValue = distResult.distance.value;
							}
							const location = locator.locations[i];
							location.travelDistanceText = travelDistanceText;
							location.travelDistanceValue = travelDistanceValue;
						}

						// Re-render the results list, in case the ordering has changed.
						locator.renderResultsList();
					}
				};
				distanceMatrixService.getDistanceMatrix(request, callback);
			};
		}

		function loadiingAnimation() {
			sector
				.querySelector('svg.retailer-locations__icon')
				.classList.toggle('retailer-locations__icon--hidden');
			sector
				.querySelector('svg.retailer-locations__loading-animation')
				.classList.toggle(
					'retailer-locations__loading-animation--show'
				);
		}

		// eslint-disable-next-line no-undef
		new LocatorPlus(config);
	}
}

class Handler {
	constructor(sector, sectorClass) {
		// Store values
		this.sector = sector;
		this.sectorClass = sectorClass;
		new FindRetailer(this.sector);
	}
}

// Init a handler for each block instance
const sectorClass = 'retailer-locations';
const sectors = Array.from(document.querySelectorAll(`section.${sectorClass}`));
sectors.forEach((o) => new Handler(o, sectorClass));
