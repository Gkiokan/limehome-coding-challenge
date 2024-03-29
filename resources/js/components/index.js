import Vue from 'vue'
import Card from './Card'
import Child from './Child'
import Button from './Button'
import Checkbox from './Checkbox'
import { HasError, AlertError, AlertSuccess } from 'vform'

import LimeHomeLoader from './LimeHomeLoader'
import DebugObject from './DebugObject'
import PlacesList from './PlacesList'
import PlacesCard from './PlacesCard'
import Carousel from './Carousel'
import SimplePlaceHeader from './SimplePlaceHeader'
import BookingForm from './BookingForm'

// Components that are registered globaly.
[
  Card,
  Child,
  Button,
  Checkbox,
  HasError,
  AlertError,
  AlertSuccess,

  // custom components
  DebugObject,
  LimeHomeLoader,
  PlacesList,
  PlacesCard,
  Carousel,
  SimplePlaceHeader,
  BookingForm,
].forEach(Component => {
  Vue.component(Component.name, Component)
})
